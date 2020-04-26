<!-- Page Content  -->
<div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                </button>
                <span class="menu-text">Reward</span>
            </div>
            <!-- row begins -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="margin-bottom: 10px;">
                        <div class="card-header text-muted">Details</div>
                        <div class="card-body">
						<?php $data = $this->session->flashdata('user_reward_data') ?>
                            <table class="table table-borderless table-sm table-responsive-sm table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>Card Name:</strong>
                                        </td>
                                        <td><?= $data['card_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Card Number:</strong>
                                        </td>
                                        <td><?= $data['card_number'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Amount Paid:</strong>
                                        </td>
                                        <td><?=  'N'.number_format((double)$data['amount_paid']  , 2, '.', ',') ?></td>
                                    </tr>
									<tr>
                                        <td>
                                            <strong>Business Volume:</strong>
                                        </td>
                                        <td><?= $data['bv'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Expected Reward:</strong>
                                        </td>
                                        <td><?=  'N'.number_format((double)$data['expected_reward'] , 2, '.', ',') ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Cashout Requested:</strong>
                                        </td>
                                        <td><?= 'N'.number_format((double)$data['cashout_amount_requested']  , 2, '.', ',') ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Cashout Paid:</strong>
                                        </td>
                                        <td><?= 'N'.number_format((double)$data['cashout_amount_paid']  , 2, '.', ',')?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>Balance:</strong>
                                        </td>
                                        <td><?= 'N'.number_format((double)$data['expected_reward'] -  (double)$data['cashout_amount_paid'] , 2, '.', ',') ?></td>
										<?php $this->session->set_userdata('reward_balance', (double)$data['expected_reward'] - (double)$data['cashout_amount_paid']); ?>
                                    </tr>
                                </tbody>
                            </table>
							<?php $error = $this->session->flashdata('user_reward_error') ?>
							<?php if ($error): ?>
								<?php echo '<div style="color:red; font-size:14px;">' . $error . '</div>';?>
							<?php endif;?>
                            <form class="form-inline" action="<?php echo base_url(); ?>user/reward/requestCashout" method="POST" enctype="multipart/form-data">
                                <div class="form-group mb-2">
                                    <label for=""></label>
                                    <input type="number" class="form-control" name="amount" id="" aria-describedby="helpId" placeholder="Enter amount">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Request Cashout</button>
                            </form>
                        </div>
                    </div>

					<?php if ($data['cashout_amount_requested'] != 0): ?>
						<div class="card" style="margin-bottom: 10px; max-width: 25rem;">
							<div class="card-header text-white bg-secondary">Pending Cashout</div>
							<div class="card-body">
								<table class="table table-borderless table-sm">
									<tbody>
										<tr>
											<td>
												<strong>Amount Requested:</strong>
											</td>
											<td><?=  'N'.number_format($data['cashout_amount_requested'] , 2, '.', ',') ?></td>
										</tr>
										<tr>
											<td>
												<strong>Request Date</strong>
											</td>
											<td><?= date('F j Y', strtotime($data['cashout_request_date']))  ?></td>
										</tr>
									</tbody>
								</table>
								<form class="form-inline" action="<?php echo base_url(); ?>user/reward/deleteCashoutRequest" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="" value="">
									<button type="submit" class="btn btn-danger mb-2">Delete Request</button>
								</form>
							</div>
						</div>
					<?php endif; ?>

                    <!-- <div class="card">
                  <div class="card-header text-muted">2</div>
                  <div class="card-body">
                          <table class="table table-borderless table-sm">
                                  <tbody>
                                  <tr>
                                      <td><strong>Code:</strong></td>
                                      <td>LAGPK21702197638</td>
                                  </tr>
                                  <tr>
                                      <td><strong>Name:</strong></td>
                                      <td>Onobe Fristina</td>
                                  </tr>
                                  <tr>
                                      <td><strong>Agent:</strong></td>
                                      <td>Bota Florence</td>
                                  </tr>
                                  <tr>
                                      <td><strong>Date:</strong></td>
                                      <td>Friday, 5 March 2019</td>
                                  </tr>
                                  </tbody>
                              </table>
                      <a href="#" class="btn btn-primary">Confirm</a>
                      <a href="#" class="btn btn-danger">Decline</a>
                  </div>
              </div> -->


                </div>

                <!-- row ends -->
            </div>

        </div>
