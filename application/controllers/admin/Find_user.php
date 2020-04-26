<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find_user extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('admin_id')) {
			$this->load->view('admin/includes/header');
			$this->load->view('admin/find_user');
			$this->load->view('admin/includes/footer');
		} else {
			redirect('admin/login');
		}
	}

	public function find () {
		$card_number = $this->input->post('code');
		$result = $this->Ad_find_user_model->getUserData($card_number);
		if (empty($result)) {
			$this->session->set_flashdata('adm_user_data', 'empty');
		} else {
			$this->session->set_flashdata('adm_user_data', $result);
		}
		redirect('admin/find_user');
	}
}
