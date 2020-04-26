<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('userid')) {
			redirect('user/dashboard');
		} else {
			$this->load->view('user/login');
		}
	}

	public function validate()	{
		// $this->load->view('user/login');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('validation_errors', validation_errors());
			redirect('user/login');
        } else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$result = $this->User_model->login($username, $password);

			if (is_string($result)) {
				$this->session->set_flashdata('loginMessage', $result);

				redirect('user/login');
			} elseif ($result) {
				redirect('user/dashboard');
			} else {
				$this->session->set_flashdata('loginMessage', 'Incorrect Password');

				redirect('user/login');
			}
        }
	}
}
