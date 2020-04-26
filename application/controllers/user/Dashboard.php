<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		if ($this->session->userdata('userid')) {
			$this->load->view('user/includes/header');
			$this->load->view('user/dashboard');
			$this->load->view('user/includes/footer');
		} else {
			redirect('user/login');
		}
	}
}
