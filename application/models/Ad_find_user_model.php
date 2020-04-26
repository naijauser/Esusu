<?php
	class Ad_find_user_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function getUserData ($cardNumber) {
			$this->db->select('users_meta.user_id, users_meta.card_number, users_meta.request_date, users_meta.account_status,
								users.surname, users.firstname, users.username, users.phone_number, users.email');
			$this->db->from('users_meta');
			$this->db->where('card_number', $cardNumber);
			$this->db->join('users', 'users_meta.user_id = users.user_id');
			return $this->db->get()->result();
		}
	}
