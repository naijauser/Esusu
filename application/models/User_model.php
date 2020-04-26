<?php 

	class User_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}


		public function login($username, $password) {
			//Validate 
			$this->db->where('username', $username);

			$result = $this->db->get('users')->result();

			if(empty($result)) {
				return 'Oops! We do not recognize this username.';
			} else if (!empty($result)) {
				$userId = $this->getUserIdFromUsername($username)[0]->user_id;
				$this->db->select('account_status');
				$this->db->where('user_id', $userId);
				$acc_result = $this->db->get('users_meta')->result()[0]->account_status;

				if ( $acc_result == 'approved') {
					$result = $result[0];
					$db_password = $result->password;

					if (password_verify($password, $db_password)) {
						$this->session->set_userdata('userid', $result->user_id);
						return true;
					} else {
						return false;
					}
				} else {
					return 'Your account is yet to be approved, Please contact the admin.';
				}
			}
		}

		public function register($form_data) {
			$gender = '';

			if ($form_data['gender'] == 1) {
				$gender = 'Male';
			} else {
				$gender = 'Female';
			}

			$table_data = array(
				'surname' => $form_data['surname'],
				'firstname' => $form_data['firstname'],
				'username' => $form_data['username'],
				'email' => $form_data['email'],
				'password' =>password_hash($form_data['password'], PASSWORD_DEFAULT) ,
				'address' => $form_data['address'],
				'state' => $form_data['state_of_residence'],
				'phone_number' => $form_data['phone'],
				'gender' => $gender,
			);

			if ($this->db->insert('users', $table_data)) {
				//Get the last inserted id, which is the user id
				$userId = $this->db->insert_id();

				//load the value_helper
				$this->load->helper('value_helper');

				// get state code from value_helper
				$stateCode = getStateCode($form_data['state_of_residence']);

				// get package code from value_helper
				$packageCode = getPackageCode($form_data['package']);

				$cardNumber = 'CRD' . $packageCode . date('dmY') . rand(1000,9999);

				$filename = $this->uploadImage();
				if ($filename == false) {
					$filename = '';
				}

				$table_data2 = array(
					'user_id' => $userId,
					'package' => $form_data['package'],
					'card_number' => $cardNumber,
					'payment_receipt' => $filename
				);
				$this->db->insert('users_meta', $table_data2);

				$table_data3 = array(
					'user_id' => $userId,
					'parent_id' => $this->getUserIdFromUsername($form_data['referrer'])[0]->user_id,
				);
				return $this->db->insert('referral', $table_data3);

			} else {
				return false;
			}
		}

		public function uploadImage () {
			$allowedExts = array('gif', 'jpeg', 'jpg', 'png');
			$temp = explode('.', $_FILES['payment_proof']['name']);
			$extension = end($temp);

			if ((($_FILES['payment_proof']['type'] == 'image/gif')
					|| ($_FILES['payment_proof']['type'] == 'image/jpeg')
					|| ($_FILES['payment_proof']['type'] == 'image/jpg')
					|| ($_FILES['payment_proof']['type'] == 'image/pjpeg')
					|| ($_FILES['payment_proof']['type'] == 'image/x-png')
					|| ($_FILES['payment_proof']['type'] == 'image/png'))
					&& ($_FILES['payment_proof']['size'] < 2000000)
					&& in_array($extension, $allowedExts)) 
			{
				if ($_FILES['payment_proof']['error'] > 0) {
					$this->session->set_flashdata('uploaderror', $_FILES['payment_proof']['error']);
					return false;
				} else {
					move_uploaded_file($_FILES['payment_proof']['tmp_name'],
						'uploads/'.$_FILES['payment_proof']['name']);
						return $_FILES['payment_proof']['name'];
				}                   
			} else {
				$this->session->set_flashdata('uploaderror', 'Invalid File type!');
				return false;
			}
		}

		public function getUserIdFromUsername ($username) {
			$this->db->select('user_id');
			$this->db->where('username', $username);

			return $this->db->get('users')->result();
		}

		public function getUsernameFromUserId ($userId) {
			$this->db->select('username');
			$this->db->where('user_id', $userId);

			return $this->db->get('users')->result()[0]->username;
		}

		public function emailExists($email) {
			$this->db->select('email');
			$this->db->where('email', $email);
			$query = $this->db->get('users')->result();
			
			if (empty($query)) {
				return false;
			} else {
				return true;
			}
		}

		public function usernameExists($username) {
			$this->db->select('username');
			$this->db->where('username', $username);
			$query = $this->db->get('users')->result();

			if (empty($query)) {
				return false;
			} else {
				return true;
			}
		}

		/**
		 * Functions below this comment are specific to the admin
		 */
		public function getTotalSignups () {
			$this->db->where('account_status', 'approved');
			$this->db->from('users_meta');
			return  $this->db->count_all_results();
		}

		public function getThisMonthSignups () {
			$lastmonth = date("Y-m-d H:i:s", mktime(23, 59, 59, date("n"), 0, date("Y")));
			$this->db->where('approval_date >', $lastmonth);
			$this->db->from('users_meta');
			return  $this->db->count_all_results();
		} 

		public function getThisWeekSignUps () {
			$lastmonth = date("Y-m-d H:i:s", mktime(23, 59, 59, date("n"), date("j")-7, date("Y")));
			$this->db->where('approval_date >', $lastmonth);
			$this->db->from('users_meta');
			return  $this->db->count_all_results();
		}

		public function getTodaySignUps () {
			$lastmonth = date("Y-m-d H:i:s", mktime(23, 59, 59, date("n"), date("j")-1, date("Y")));
			$this->db->where('approval_date >', $lastmonth);
			$this->db->from('users_meta');
			return  $this->db->count_all_results();
		}
	}
