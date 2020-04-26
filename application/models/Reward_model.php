<?php 

	class Reward_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function prepData() {
			$data = [];
			array_push($data, $this->card_num_package());
			array_push($data, $this->amount_paid());
			array_push($data, $this->expected_reward());
			array_push($data, $this->cashout_amount_requested());
			array_push($data, $this->cashout_paid());
			array_push($data, $this->balance());

			return $data;
		}

		public function card_num_package () {
			$user_id = $this->session->userdata('userid');

			$this->db->select('packages.name,users_meta.card_number');
			$this->db->from('users_meta');
			$this->db->where('user_id', $user_id);
			$this->db->join('packages', 'users_meta.package = packages.id');
			$result = $this->db->get()->result()[0];

			return [
				'card_name' => $result->name,
				'card_number' => $result->card_number
			];
		}

		public function amount_paid () {
			// Grab user id from session
			$user_id = $this->session->userdata('userid');

			// Query referral_depth table to grab exchange rate
			$this->db->select('percent');
			$this->db->where('referral_depth', 11);
			$exchage_rate = $this->db->get('referral_reward')->result()[0]->percent;

			// Join users_meta and packages table to get package usd value
			$this->db->select('packages.value_in_usd');
			$this->db->from('users_meta');
			$this->db->where('user_id', $user_id);
			$this->db->join('packages', 'users_meta.package = packages.id');
			$package_value_usd = $this->db->get()->result()[0]->value_in_usd;

			$value_in_naira = (double)$exchage_rate * (double)$package_value_usd;

			return [
				'amount_paid' => (double)$value_in_naira
			];
		}

		public function expected_reward () {
			return [
				
				'expected_reward' => (double)$this->amount_paid()['amount_paid'] * 2
			];
		}

		public function cashout_amount_requested () {
			$user_id = $this->session->userdata('userid');

			$this->db->select('amount, request_date');
			$this->db->where('user_id', $user_id);
			$this->db->where('cashout_status', 'pending');
			$result = $this->db->get('reward_cashout_history')->result();
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

		public function cashout_paid () {
			$user_id = $this->session->userdata('userid');
			$amount = 0;

			// var_dump($user_id);
			// echo '<br>';

			$this->db->select('amount');
			$this->db->where('user_id', $user_id);
			$this->db->where('cashout_status', 'approved');
			$result = $this->db->get('reward_cashout_history')->result();
			// var_dump($result);
			// echo '<br>';

			if (empty($result)) {
				$amount = 0;
			} else {
				foreach ($result as $value) {
					$amount += $value->amount;
				}
			}
			// var_dump($amount);
			// die();
			return [
				'cashout_amount_paid' => $amount
			];
		}

		public function balance () {
			return [
				'balance' => 0
			];
		}

		// Request Cashout
		public function request_cashout($amount) {
			$user_id = $this->session->userdata('userid');
			$expectedReward = $this->session->userdata('reward_balance');
			// var_dump($expectedReward);
			// echo '<br>';

			// Check if user has a pending request
			if ($this->isPendingRequest($user_id)) {
				echo 'is pending <br>';
				$this->db->select('amount');
				$this->db->where('user_id', $user_id);
				$this->db->where('cashout_status', 'pending');
				$pendingAmount = $this->db->get('reward_cashout_history')->result()[0]->amount;
				// var_dump($amount);
				// echo '<br>';
				// var_dump($pendingAmount);
				// echo '<br>';
				// die();

				$amount += $pendingAmount;
				
				if ($amount < $expectedReward) {
					$this->db->set('amount', $amount);
					$this->db->where('user_id', $user_id);
					$this->db->where('cashout_status', 'pending');
					$this->db->update('reward_cashout_history');
				}

			} else {
				$insert_data = array(
					'user_id' => $user_id,
					'amount' => $amount
				);
				$reward = $this->db->insert('reward_cashout_history', $insert_data);
			}
		}

		// Check for pending cashout request
		public function isPendingRequest ($user_id) {
			// var_dump($user_id);
			// echo '<br>';
			$this->db->where('user_id', $user_id);
			$this->db->where('cashout_status', 'pending');
			$this->db->from('reward_cashout_history');
			$result =  $this->db->count_all_results();
			var_dump($result);
			if ($result != 0) {
				return true;
			} else {
				return false;
			}
		}

		public function deleteCashoutRequest () {
			$user_id = $this->session->userdata('userid');
			$this->db->where('user_id', $user_id);
			$this->db->delete('reward_cashout_history');
			// var_dump($this->db->delete('referral_cashout_history'));
		}

	}
