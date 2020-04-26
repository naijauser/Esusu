<?php 

	class Cashout_history_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function getRewardCashoutHistory () {
			$user_id = $this->session->userdata('userid');

			$this->db->select('amount, request_date, approval_date');
			$this->db->where('user_id', $user_id);
			$this->db->where('cashout_status', 'approved');
			$result = $this->db->get('reward_cashout_history')->result();
			
			return $result;
		}

		public function getReferralCashoutHistory () {
			$user_id = $this->session->userdata('userid');

			$this->db->select('amount, request_date, approval_date');
			$this->db->where('user_id', $user_id);
			$this->db->where('cashout_status', 'approved');
			$result = $this->db->get('referral_cashout_history')->result();
			
			return $result;
		}
	}
