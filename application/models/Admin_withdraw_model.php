<?php 

	class Admin_withdraw_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function getTotalWithdrawalsApproved () {
			$this->db->where('cashout_status', 'approved');
			$this->db->from('reward_cashout_history');
			$result1 = $this->db->count_all_results();

			$this->db->where('cashout_status', 'approved');
			$this->db->from('referral_cashout_history');
			$result2 = $this->db->count_all_results();

			return $result1 + $result2;
		}

		public function getTotalWithdrawalsPending () {
			$this->db->where('cashout_status', 'pending');
			$this->db->from('reward_cashout_history');
			$result1 = $this->db->count_all_results();

			$this->db->where('cashout_status', 'pending');
			$this->db->from('referral_cashout_history');
			$result2 = $this->db->count_all_results();

			return $result1 + $result2;
		}

		public function getTotalWithdrawalsDeclined () {
			$this->db->where('cashout_status', 'declined');
			$this->db->from('reward_cashout_history');
			$result1 = $this->db->count_all_results();

			$this->db->where('cashout_status', 'declined');
			$this->db->from('referral_cashout_history');
			$result2 = $this->db->count_all_results();

			return $result1 + $result2;
		}

		public function getRewardRequests () {

			$this->db->select('reward_cashout_history.user_id, reward_cashout_history.amount, 
					reward_cashout_history.request_date, users.surname, users.firstname, users_meta.card_number');
			$this->db->from('reward_cashout_history');
			$this->db->where('cashout_status','pending');
			$this->db->join('users', 'reward_cashout_history.user_id = users.user_id');
			$this->db->join('users_meta', 'reward_cashout_history.user_id = users_meta.user_id');
			return $this->db->get()->result();
		}

		public function getReferralRequests () {

			$this->db->select('referral_cashout_history.user_id, referral_cashout_history.amount, 
					referral_cashout_history.request_date, users.surname, users.firstname, users_meta.card_number');
			$this->db->from('referral_cashout_history');
			$this->db->where('cashout_status','pending');
			$this->db->join('users', 'referral_cashout_history.user_id = users.user_id');
			$this->db->join('users_meta', 'referral_cashout_history.user_id = users_meta.user_id');
			return $this->db->get()->result();
		}

		public function approveWithdrawal ($user_id, $message, $table) {
			if ($table == 'reward') {
				$this->db->set('cashout_status', $message);
				$this->db->set('approval_date', 'NOW()', FALSE);
				$this->db->where('user_id', $user_id);
				$this->db->update('reward_cashout_history');
			} else  if ($table == 'referral') {
				$this->db->set('cashout_status', $message);
				$this->db->set('approval_date', 'NOW()', FALSE);
				$this->db->where('user_id', $user_id);
				$this->db->update('referral_cashout_history');
			}
		}
	}
