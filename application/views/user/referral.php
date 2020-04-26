<!-- Page Content  -->
<div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                </button>
                <span class="menu-text">Referral</span>
            </div>
            <!-- row begins -->
            <div class="row">
                <div class="col-md-8">
					<?php $data = $this->session->flashdata('user_referral_data'); ?>
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="card-body">
                            <table class="table table-sm table-responsive-sm">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Total accumulated referral bonus:</strong>
                                        </td>
                                        <td><?= 'N'.number_format((double)$data['totalRefBonus'] , 2, '.', ',')?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Total withdrawn amount:</strong>
                                        </td>
                                        <td><?= 'N'.number_format((double)$data['withdrawnAmt'] , 2, '.', ',')?></td>
                                    </tr>
									<tr>
                                        <td>
                                            <strong>Balance available for withdrawal:</strong>
                                        </td>
                                        <td><?= 'N'.number_format((double)$data['totalRefBonus']-(double)$data['withdrawnAmt'] , 2, '.', ',')?></td>
										<?php $this->session->set_userdata('balance', (double)$data['totalRefBonus']-(double)$data['withdrawnAmt']); ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

					<div class="card" style="margin-bottom: 10px;">
					<?php $error = $this->session->flashdata('user_referral_error'); ?>
                        <div class="card-body">
							<?php if ($error) 
								echo '<div class="text-danger" style="font-size: 14px;">' . $error . '</div>';
							?>
							<form class="form-inline" action="<?php echo base_url(); ?>user/referral/requestCashout" method="POST" enctype="multipart/form-data">
								<div class="form-group mb-2">
									<label for=""></label>
									<input type="number" class="form-control" name="amount" id="" aria-describedby="helpId" placeholder="Enter amount">
								</div>
								<button type="submit" class="btn btn-primary mb-2">Request Cashout</button>
								<small><strong>Note:</strong> Cashout amount should be less than <strong>'Balance available for withdrawal'</strong></small>
							</form>
						</div>
					</div>

					<?php if ($data['cashout_amount_requested']['cashout_amount_requested'] != 0): ?>
						<div class="card" style="margin-bottom: 10px; max-width: 25rem;">
							<div class="card-header text-white bg-secondary">Pending Cashout</div>
							<div class="card-body">
								<table class="table table-borderless table-sm">
									<tbody>
										<tr>
											<td>
												<strong>Amount Requested:</strong>
											</td>
											<td><?= 'N'.number_format((double)$data['cashout_amount_requested']['cashout_amount_requested'], 2, '.', ',')?></td>
										</tr>
										<tr>
											<td>
												<strong>Request Date</strong>
											</td>
											<td><?= date('F j Y', strtotime($data['cashout_amount_requested']['cashout_request_date']))  ?></td>
										</tr>
									</tbody>
								</table>
								<form class="form-inline" action="<?php echo base_url(); ?>user/referral/deleteCashoutRequest" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="" value="">
									<button type="submit" class="btn btn-danger mb-2">Delete Request</button>
								</form>
							</div>
						</div>
					<?php endif; ?>


					<?php if ($data['referralList'] == '') : ?>
					<div class="card" style="margin-bottom: 10px;">
						<div class="card-body">
							<p>You do not have any referrals yet.</p>
						</div>
					</div>
					<?php else : ?>
						<div class="card" style="margin-bottom: 10px;">
							<h3 class="card-title" style="margin:5px;">Your Referrals</h3>
							<div class="card-body">
								<table class="table table-sm table-responsive-sm">
									<thead>
										<tr>
											<th scope="col">Level</th>
											<th scope="col">Username</th>
											<th scope="col">Amount(N)</th>
										</tr>
									</thead>
									<tbody>
										<?= $data['referralList'] ?>
									</tbody>
								</table>
							</div>
						</div>
					<?php endif; ?>
                    


                </div>

                <!-- row ends -->
            </div>
        </div>


    </div>
