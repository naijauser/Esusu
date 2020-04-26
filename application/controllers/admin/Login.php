<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()	{
		$this->load->view('admin/login');
	}

	public function validate()	{
		// $this->load->view('user/login');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('login_validation_errors', validation_errors());
			redirect('admin/login');
        } else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$result = $this->Ad_login_model->login($username, $password);

			if (is_string($result)) {
				$data['loginMessage'] = $result;

				$this->session->set_flashdata('loginMessage', $result);
				redirect('admin/login');
			} elseif ($result) {
				redirect('admin/dashboard');
			} else {
				$data['loginMessage'] = 'Incorrect Password';

				$this->session->set_flashdata('loginMessage', 'Incorrect Password');
				redirect('admin/login');
			}
        }
	}
}
