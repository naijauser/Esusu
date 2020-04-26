<?php 

	class Admin_acct_verify_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function countApprovedAccounts () {
			$this->db->where('account_status', 'approved');
			$this->db->from('users_meta');
			return $this->db->count_all_results();
		}

		public function countPendingAccounts () {
			$this->db->where('account_status', 'pending');
			$this->db->from('users_meta');
			return $this->db->count_all_results();
		}

		public function countDeclinedAccounts () {
			$this->db->where('account_status', 'declined');
			$this->db->from('users_meta');
			return $this->db->count_all_results();
		}

		public function getAccountVerifyRequestList () {
			$this->db->select('users_meta.user_id, users_meta.card_number, users_meta.request_date, users_meta.payment_receipt,
								users.surname, users.firstname, users.username, users.phone_number, users.email');
			$this->db->from('users_meta');
			$this->db->where('account_status','pending');
			$this->db->join('users', 'users_meta.user_id = users.user_id');
			return $this->db->get()->result();
		}

		public function approveWithdrawal ($user_id, $message) {
			$this->db->set('account_status', $message);
			$this->db->set('approval_date',  'NOW()', FALSE);
			$this->db->where('user_id', $user_id);
			$this->db->update('users_meta');
		}
	}
