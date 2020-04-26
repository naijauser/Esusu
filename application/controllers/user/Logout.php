<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('userid')) {
			$this->session->sess_destroy();
			redirect('user/login');
		} else {
			$data['loginMessage'] = '';
			$this->load->view('user/login', $data);
		}
	}
}
