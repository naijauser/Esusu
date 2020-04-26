<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BV_percent_manage extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('admin_id')) {
			$bvValues = $this->Referral_model->getbvValues();

			$this->session->set_flashdata('adm_bv_data', $bvValues);

			$this->load->view('admin/includes/header');
			$this->load->view('admin/bv_percent_manage');
			$this->load->view('admin/includes/footer');
		} else {
			redirect('admin/login');
		}
	}

	public function updateData () {
		$this->Referral_model->updatebvValues($this->input->post());
		$this->session->set_flashdata('adm_bv_data_updated', 'Data Updated!');
		redirect('admin/bv_percent_manage');
	}
}
