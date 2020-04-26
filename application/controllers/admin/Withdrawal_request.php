<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdrawal_request extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('admin_id')) {
			$data = $this->prepData();

			$this->load->view('admin/includes/header');
			$this->load->view('admin/withdrawal_request', $data);
			$this->load->view('admin/includes/footer');
		} else {
			redirect('admin/login');
		}
		
	}

	public function response ($user_id, $message, $table) {
		if ($message == 'approve') {
			$this->Admin_withdraw_model->approveWithdrawal($user_id, 'approved', $table);
		} else if ($message == 'decline') {
			$this->Admin_withdraw_model->approveWithdrawal($user_id, 'declined', $table);
		}
		redirect('admin/withdrawal_request');
	}

	public function prepData () {
		$approvedWithdrawal = $this->Admin_withdraw_model->getTotalWithdrawalsApproved();
		$pendingWithdrawal = $this->Admin_withdraw_model->getTotalWithdrawalsPending();
		$declinedWithdrawal = $this->Admin_withdraw_model->getTotalWithdrawalsDeclined();
		$rewardRequests = $this->Admin_withdraw_model->getRewardRequests();
		$referralRequests = $this->Admin_withdraw_model->getReferralRequests();

		// var_dump($approvedWithdrawal);
		// echo '<br>';
		// echo '<br>';
		// var_dump($pendingWithdrawal);
		// echo '<br>';
		// echo '<br>';
		// var_dump($rewardRequests);
		// echo '<br>';
		// echo '<br>';
		// var_dump($referralRequests);
		// echo '<br>';
		// echo '<br>';
		// die();

		return [
			'approvedWithdrawal' => $approvedWithdrawal,
			'pendingWithdrawal' => $pendingWithdrawal,
			'rewardRequests' => $rewardRequests,
			'referralRequests' => $referralRequests,
			'declinedWithdrawal' => $declinedWithdrawal
		];
	}
}
