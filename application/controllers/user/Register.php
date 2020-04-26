<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index()	{
		$this->load->view('user/register');
	}

	public function validate() {
		$response = $this->input->post('g-recaptcha-response');
		$this->config->load('api_config');
		
		$recaptcha_secret_key = $this->config->item('recaptcha_secret_key');

        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$recaptcha_secret_key.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);
		if ($responseData->success == false) {
			$this->session->set_flashdata('exist_reg_error', '<p>Hello Bot!</p>');
			redirect('user/register');
		} 

		$this->form_validation->set_rules('surname', 'Surname', 'required');
		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|alpha_numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('state_of_residence', 'State', 'required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required|integer|max_length[11]|min_length[10]');
		$this->form_validation->set_rules('referrer', 'Referrer Username', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('package', 'Package', 'required');

		$data = [
			'surname' => $this->input->post('surname'),
			'firstname' => $this->input->post('firstname'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'state_of_residence' => $this->input->post('state_of_residence'),
			'phone' => $this->input->post('phone'),
			'referrer' => $this->input->post('referrer'),
		];
		$this->session->set_flashdata('user_register_data', $data);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('validation_errors', validation_errors() );
			redirect('user/register');
        } else {
			$emailExists = $this->User_model->emailExists($data['email']);
			$usernameExists = $this->User_model->usernameExists($data['username']);

			if ($emailExists || $usernameExists == true) {
				if ($emailExists == true) {
					$this->session->set_flashdata('exist_reg_error', '<p>Email already exists.</p>');
				}

				if ($usernameExists == true) {
					$this->session->set_flashdata('exist_reg_error2', '<p>Username already exists.</p>');
				}

				redirect('user/register');
			} else {
				if ($this->User_model->register($this->input->post())) {
					$data = $this->getData();
					$this->session->set_flashdata('user_register_data',$data);

					$this->session->set_flashdata('register_successful', '<p>You have successfully registered. 
					Please <a href="' . base_url() . 'user/login">Login.</a>
				</p>');
				redirect('user/register');
				} else {
					$this->session->set_flashdata('exist_reg_error', '<p>Oops! Something went wrong. Please try again.</p>');
					redirect('user/register');
				}
			}
        }
	}

	public function getData() {
		return [
			'surname' => '',
			'firstname' => '',
			'username' => '',
			'email' => '',
			'address' => '',
			'state_of_residence' => '',
			'phone' => '',
			'referrer' => ''
		];
	}
}
