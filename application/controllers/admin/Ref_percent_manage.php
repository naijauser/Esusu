<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ref_percent_manage extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('admin_id')) {
			$bvValues = $this->Referral_model->getrefValues();;

			$this->session->set_flashdata('adm_ref_data', $bvValues);			

			$this->load->view('admin/includes/header');
			$this->load->view('admin/ref_percent_manage');
			$this->load->view('admin/includes/footer');
		} else {
			redirect('admin/login');
		}
	}

	public function updateData () {
		$this->Referral_model->updaterefValues($this->input->post());
		$this->session->set_flashdata('adm_ref_data_updated', 'Data Updated!');	
		redirect('admin/ref_percent_manage');
	}
}
