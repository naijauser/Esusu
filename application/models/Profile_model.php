<?php 

	class Profile_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}
		
		public function getProfileDetails () {
			$user_id = $this->session->userdata('userid');
			$this->db->select('email, phone_number, username');
			$this->db->where('user_id', $user_id);
			$result = $this->db->get('users')->result()[0];

			return $result;
		}

		public function getbankDetails () {
			$user_id = $this->session->userdata('userid');
			$this->db->select('account_name, account_number, bank');
			$this->db->where('user_id', $user_id);
			$result = $this->db->get('users_bank')->result();

			if (empty($result)) {
				$result = [];
			} else {
				$result = $result[0];
			}

			return $result;
		}

		public function update ($formData) {
			$user_id = $this->session->userdata('userid');

			$email = $formData['email'];
			$phone = $formData['phone'];
			$account_name = $formData['account_name'];
			$account_number = $formData['account_number'];
			$bank = $formData['bank'];

			$array = array(
				'email' => $email,
				'phone_number' => $phone
			);		
			$this->db->set($array);
			$this->db->where('user_id', $user_id);
			$result1 = $this->db->update('users');

			$array = array(
				'account_name' => $account_name,
				'account_number' => $account_number,
				'bank' => $bank
			);		
			$this->db->set($array);
			$this->db->where('user_id', $user_id);
			$result2 = $this->db->update('users_bank');

			if ($result1 && $result2) {
				return true;
			} else {
				return false;
			}
		}

		public function updatePassword ($formData) {
			$user_id = $this->session->userdata('userid');
			$password = $formData['password'];
			$password = password_hash($formData['password'], PASSWORD_DEFAULT);
			$this->db->set('password', $password);
			$this->db->where('user_id', $user_id);
			$result = $this->db->update('users');

			return $result;
		}
	}
