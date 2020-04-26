<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_verify_request extends CI_Controller {
	public function index()	{
		if ($this->session->userdata('admin_id')) {
			$data = $this->prepData();
			$this->load->view('admin/includes/header');
			$this->load->view('admin/account_verification_request', $data);
			$this->load->view('admin/includes/footer');
		} else {
			redirect('admin/login');
		}
	}

	public function response ($user_id, $message) {
		if ($message == 'approve') {
			$this->Admin_acct_verify_model->approveWithdrawal($user_id, 'approved');
		} else if ($message == 'decline') {
			$this->Admin_acct_verify_model->approveWithdrawal($user_id, 'declined');
		}
		redirect('admin/account_verify_request');
	}

	public function prepData () {
		$approvedCount = $this->Admin_acct_verify_model->countApprovedAccounts();
		$pendingCount = $this->Admin_acct_verify_model->countPendingAccounts();
		$declinedCount = $this->Admin_acct_verify_model->countDeclinedAccounts();
		$verifyList = $this->Admin_acct_verify_model->getAccountVerifyRequestList();

		return [
			'approvedCount' => $approvedCount,
			'pendingCount' => $pendingCount,
			'declinedCount' => $declinedCount,
			'verifyList' => $verifyList
		];
	}
}
