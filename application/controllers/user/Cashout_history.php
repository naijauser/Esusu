<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashout_history extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('userid')) {
			$data = $this->prepData();
			$this->load->view('user/includes/header');
			$this->load->view('user/cashout_history',$data);
			$this->load->view('user/includes/footer');
		} else {
			redirect('user/login');
		}
	}

	public function prepData () {
		$rewardCashoutData = $this->Cashout_history_model->getRewardCashoutHistory();
		$referralCashoutData = $this->Cashout_history_model->getReferralCashoutHistory();
		if (empty($rewardCashoutData) && empty($referralCashoutData)) {
			$merged_array = [];
		} else {
			$merged_array = array_merge($rewardCashoutData, $referralCashoutData);
		}

		return [
			'cashout_array' => $merged_array
		];
	}
}
