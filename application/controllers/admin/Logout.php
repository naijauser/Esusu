<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('admin_id')) {
			$this->session->sess_destroy();
			redirect('admin/login');
		} else {
			$data['loginMessage'] = '';
			$this->load->view('admin/login', $data);
		}
	}
}
