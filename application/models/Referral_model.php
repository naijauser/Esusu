<?php 

	class Referral_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function getReferrals ($parent_id, $level) {
			$this->db->select('user_id, parent_id');
			$this->db->where('parent_id', $parent_id);
			$query = $this->db->get('referral');
			$levels = $query->result_array();
			$myarray = array();

			if ($query->num_rows() == 0) {
				$level--;
			} else	{
				$level++;
				if($level == 0) $level = 1;
			}

			foreach($levels as $row) {
				if($level <= 10) {
					$myarray[] = [$level => $row['user_id']];
					$myarray = array_merge($myarray, $this->getReferrals($row["user_id"],$level));
				}
			}
			return $myarray;
		}

		public function getReferralList ($user_id) {
			$referral_list = '';
			$referrals = $this->getReferrals($user_id,0);
			foreach ($referrals as $key => $f) {
				foreach ($f as $key => $value) {
					$username = $this->User_model->getUsernameFromUserId($value);
					$rate = $this->getExchangeRate();
					$childPackageValue = $this->getChildPackageValue($value);
					$ref_level_percent = (double)$this->getLevelPercent($key)/100;
					$amount = (double)$rate * (double)$childPackageValue * (double)$ref_level_percent;

					// $referral_list .= $rate . '    ' . $childPackageValue . '    ' . $ref_level_percent . '<br>';
					$referral_list .= '<tr><td>' . $key . '</td>';
					$referral_list .= '<td>' . $username . '</td>';
					$referral_list .= '<td>' . number_format((double)$amount , 2, '.', ',') . '</td></tr>';
				}
			}
			return $referral_list;
		}

		public function totalRefAmount ($user_id) {
			$totalAmount = 0;
			$referrals = $this->getReferrals($user_id,0);
			foreach ($referrals as $key => $f) {
				foreach ($f as $key => $value) {
					$rate = $this->getExchangeRate();
					$childPackageValue = $this->getChildPackageValue($value);
					$ref_level_percent = (double)$this->getLevelPercent($key)/100;
					$amount = (double)$rate * (double)$childPackageValue * (double)$ref_level_percent;

					$totalAmount += $amount;
				}
			}
			return $totalAmount;
		}

		public function totalBV () {
			$user_id = $this->session->userdata('userid');
			$totalBV = 0;
			$referrals = $this->getReferrals($user_id,0);
			foreach ($referrals as $key => $f) {
				foreach ($f as $key => $value) {
					$childPackageValue = $this->getChildbvValue($value);
					$ref_level_percent = (double)$this->getBVLevelPercent($key)/100;
					$amount = (double)$childPackageValue * (double)$ref_level_percent;

					$totalBV += $amount;
				}
			}
			$result = $totalBV + $this->getChildbvValue($user_id);
			return $result;
		}

		public function getChildPackageValue ($child_id) {
			$this->db->select('packages.value_in_usd');
			$this->db->from('users_meta');
			$this->db->where('user_id',$child_id);
			$this->db->join('packages', 'users_meta.package = packages.id');
			return $this->db->get()->result()[0]->value_in_usd;
		}

		public function getChildbvValue ($child_id) {
			$this->db->select('packages.bv');
			$this->db->from('users_meta');
			$this->db->where('user_id',$child_id);
			$this->db->join('packages', 'users_meta.package = packages.id');
			return $this->db->get()->result()[0]->bv;
		}

		public function getExchangeRate () {
			$this->db->select('percent');
			$this->db->where('referral_depth', 11);
			return $this->db->get('referral_reward')->result()[0]->percent;
		}

		public function getLevelPercent ($level) {
			$array = $this->db->get('referral_reward', 10, 0)->result();
			foreach ($array as $key => $value) {
				if ($value->referral_depth == $level) {
					return $value->percent;
				}
			}
		}

		public function getBVLevelPercent ($level) {
			$array = $this->db->get('bv_reward', 10, 0)->result();
			foreach ($array as $key => $value) {
				if ($value->referral_depth == $level) {
					return $value->percent;
				}
			}
		}

		public function getTotalWithdrawnRef ($user_id) {
			$this->db->select('amount');
			$array = array('user_id =' => $user_id, 'cashout_status =' => 'approved');
			$this->db->where($array);
			$result = $this->db->get('referral_cashout_history')->result();
			$totalAmount = 0;

			if (empty($result)) {
				return $totalAmount;
			} else {
				foreach ($result as $key => $value) {
					$totalAmount += $value->amount;
				}
			}
			return $totalAmount;
		}

		public function updateUserData ($totalRefBonus, $totalWithdrawnAmount, $user_id) {
			$id = $this->getIdFromUserId($user_id);

			$sql = "UPDATE `users_meta` SET `total_acc_ref_amt` = ?, 
						`total_acc_ref_amt_withd` = ? WHERE `users_meta`.`id` = ?";
			$this->db->query($sql, array($totalRefBonus, $totalWithdrawnAmount, $id));
		}

		public function getIdFromUserId ($user_id) {
			$this->db->select('id');
			$this->db->where('user_id', $user_id);
			return $this->db->get('users_meta')->result()[0]->id;
		}

		// Request Cashout
		public function requestCashout($amount) {
			$user_id = $this->session->userdata('userid');
			$balance = $this->session->userdata('balance');

			// Check if user has a pending request
			if ($this->isPendingRequest($user_id)) {
				$this->db->select('amount');
				$this->db->where('user_id', $user_id);
				$this->db->where('cashout_status', 'pending');
				$pendingAmount = $this->db->get('referral_cashout_history')->result()[0]->amount;

				$amount += $pendingAmount;

				if ($amount > $balance) {
					$this->db->set('amount', $balance);
					$this->db->where('user_id', $user_id);
					$this->db->where('cashout_status', 'pending');
					$this->db->update('referral_cashout_history');
				} else {
					$this->db->set('amount', $amount);
					$this->db->where('user_id', $user_id);
					$this->db->where('cashout_status', 'pending');
					$this->db->update('referral_cashout_history');
				}

			} else {
				$insert_data = array(
					'user_id' => $user_id,
					'amount' => $amount
				);
				$this->db->insert('referral_cashout_history', $insert_data);
			}
		}

		// Check for pending cashout request
		public function isPendingRequest ($user_id) {
			$this->db->where('user_id', $user_id);
			$this->db->where('cashout_status', 'pending');
			$this->db->from('referral_cashout_history');
			$result =  $this->db->count_all_results();
			if ($result != 0) {
				return true;
			} else {
				return false;
			}
		}

		public function cashout_amount_requested () {
			$user_id = $this->session->userdata('userid');

			$this->db->select('amount, request_date');
			$this->db->where('user_id', $user_id);
			$this->db->where('cashout_status', 'pending');
			$result = $this->db->get('referral_cashout_history')->result();
			if (!empty($result)) {
				$amount = $result[0]->amount;
				$date = $result[0]->request_date;
			} else {
				$amount = 0;
				$date = '';
			}
			return [
				'cashout_amount_requested' => $amount,
				'cashout_request_date' => $date
			];
		}

		public function deleteCashoutRequest () {
			$user_id = $this->session->userdata('userid');
			$this->db->where('user_id', $user_id);
			$this->db->delete('referral_cashout_history');
			// var_dump($this->db->delete('referral_cashout_history'));
		}


		public function getbvValues () {
			return $this->db->get('bv_reward')->result();
		}

		public function getrefValues () {
			return $this->db->get('referral_reward')->result();
		}

		public function updatebvValues ($formData) {
			$count = 0;
			foreach ($formData as $value) {
				echo ++$count;

				$this->db->set('percent', $value);
				$this->db->where('referral_depth', $count);
				$this->db->update('bv_reward');
			}
		}

		public function updaterefValues ($formData) {
			$count = 0;
			foreach ($formData as $value) {
				echo ++$count;

				$this->db->set('percent', $value);
				$this->db->where('referral_depth', $count);
				$this->db->update('referral_reward');
			}
		}
	}
