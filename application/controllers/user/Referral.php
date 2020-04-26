<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('userid')) {
			$data = $this->prepData();

			$this->session->set_flashdata('user_referral_data', $data);

			$this->load->view('user/includes/header');
			$this->load->view('user/referral');
			$this->load->view('user/includes/footer');
		} else {
			redirect('user/login');
		}
	}

	public function requestCashout () {
		$data = $this->prepData();
		$amount = $this->input->post('amount');
		$balance = $this->session->userdata('balance');

		if ($amount == 0 || $amount == '') {
			$this->session->set_flashdata('user_referral_error', 'Please enter a valid amount.');
			redirect('user/referral');
		} else if ($amount > $balance) {
			$this->session->set_flashdata('user_referral_error', 
				"Amount cannot be greater than <strong>'Balance available for withdrawal'</strong>.");
			redirect('user/referral');
		} else {
			$this->Referral_model->requestCashout($amount);
			redirect('user/referral');
		}
	}

	public function deleteCashoutRequest () {
		$this->Referral_model->deleteCashoutRequest();
		redirect('user/referral');
	}

	public function prepData () {
		$user_id = $this->session->userdata('userid');
		$referralList = $this->Referral_model->getReferralList($user_id);
		$totalRefBonus = $this->Referral_model->totalRefAmount($user_id);
		$totalWithdrawnAmount = $this->Referral_model->getTotalWithdrawnRef($user_id);
		$cashoutAmtRequeted = $this->Referral_model->cashout_amount_requested();

		$this->Referral_model->updateUserData($totalRefBonus, $totalWithdrawnAmount,$user_id);
		
		return [
			'totalRefBonus' => $totalRefBonus,
			'withdrawnAmt' => $totalWithdrawnAmount,
			'cashout_amount_requested' => $cashoutAmtRequeted,
			'referralList' => $referralList,
		];
	}
}
