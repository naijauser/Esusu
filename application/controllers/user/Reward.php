<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends CI_Controller {
	public function index ()	{
		if ($this->session->userdata('userid')) {
			$data = $this->prepData();
			$this->session->set_flashdata('user_reward_data', $data);

			$this->load->view('user/includes/header');
			$this->load->view('user/reward');
			$this->load->view('user/includes/footer');
		} else {
			redirect('user/login');
		}
	}

	public function requestCashout () {
		$cashout_amount = $this->input->post('amount');
		$balance = $this->session->userdata('reward_balance');
		if ($cashout_amount == 0 || $cashout_amount == '') {	
			$this->session->set_flashdata('user_reward_error', 'Please enter a valid amount.');
			redirect('user/reward');
		} else if ($cashout_amount > $balance) {
			$this->session->set_flashdata('user_reward_error', "Amount cannot be greater than <strong>'Balance'</strong>");
			redirect('user/reward');
		} else {
			$this->Reward_model->request_cashout($cashout_amount);
			redirect('user/reward');
		}
	}

	public function deleteCashoutRequest () {
		$this->Reward_model->deleteCashoutRequest();
		redirect('user/reward');
	}

	public function prepData () {
		// Grab prepared data from Model
		$model_data = $this->Reward_model->prepData();
		$bv = $this->Referral_model->totalBV();

		// Format data for display in the view
		return [
			'card_name' => $model_data[0]['card_name'],
			'card_number' => $model_data[0]['card_number'],
			'amount_paid' => $model_data[1]['amount_paid'],
			'expected_reward' => $model_data[2]['expected_reward'],
			'cashout_amount_requested' => $model_data[3]['cashout_amount_requested'],
			'cashout_request_date' => $model_data[3]['cashout_request_date'],
			'cashout_amount_paid' => $model_data[4]['cashout_amount_paid'],
			'balance' => $model_data[5]['balance'],
			'bv' => $bv
		];
	}
}
