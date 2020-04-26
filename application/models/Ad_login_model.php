<?php 

	class Ad_login_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		public function login($username, $password) {
			//Validate 
			$this->db->where('username', $username);

			$result = $this->db->get('admin')->result();

			if(empty($result)) {
				return 'Oops! We do not recognize this username.';
			} else if (!empty($result)) {
				$result = $result[0];
				$db_password = $result->password;
				if (password_verify($password, $db_password)) {
					$this->session->set_userdata('admin_id', $result->id);
					$this->session->set_userdata('admin_who_is', $result->admin_who_is);
					return true;
				} else {
					return false;
				}
			}
		}
	}
