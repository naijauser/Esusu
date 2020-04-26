<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('admin_id')) {

			$data = array();
			$data['totalSignup'] = $this->User_model->getTotalSignups();
			$data['thisMonth'] = $this->User_model->getThisMonthSignups();
			$data['thisWeek'] = $this->User_model->getThisWeekSignUps();
			$data['today'] = $this->User_model->getTodaySignUps();

			$this->load->view('admin/includes/header');
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/includes/footer');
		} else {
			redirect('admin/login');
		}
	}
}
