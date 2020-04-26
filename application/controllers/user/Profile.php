<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function index() {
		if ($this->session->userdata('userid')) {
			$data = $this->prepData();
			$this->session->set_flashdata('user_profile_data', $data);

			$this->load->view('user/includes/header');
			$this->load->view('user/profile');
			$this->load->view('user/includes/footer');
		} else {
			redirect('user/login');
		}
	}

	public function update () {
		$result = $this->Profile_model->update($this->input->post());
		$data = $this->prepData();

		if ($result) {
			$this->session->set_flashdata('success', 'Your data has been successfully updated!.');
			redirect('user/profile');
		} else {
			$this->session->set_flashdata('error', 'Yepa! Something went wrong, please try again.');
			redirect('user/profile');
		}
	}

	public function updatePassword () {
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

		$data = $this->prepData();

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('profile_validation_errors', validation_errors());
			redirect('user/profile');			
		} else {
			$result = $this->Profile_model->updatePassword($this->input->post());
			if ($result) {
				$this->session->set_flashdata('success2', 'Your password has been successfully updated!.');
				redirect('user/profile');
			} else {
				$this->session->set_flashdata('error2', 'Yepa! Something went wrong, please try again.');
				redirect('user/profile');
			}
		}
	}

	public function prepData () {
		$profDetail = $this->Profile_model->getProfileDetails();
		$bankDetails = $this->Profile_model->getbankDetails();
		if (empty($bankDetails)) {
			$accountname = '';
			$account_number = '';
			$bank = '';
		} else {
			$accountname = $bankDetails->account_name;
			$account_number = $bankDetails->account_number;
			$bank = $bankDetails->bank;
		}

		return [
			'email' => $profDetail->email,
			'phone_number' => $profDetail->phone_number,
			'username' => $profDetail->username,
			'accountname' => $accountname,
			'account_number' => $account_number,
			'bank' => $bank,
		];
	}
}
