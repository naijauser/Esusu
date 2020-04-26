 <!-- Page Content  -->
 <div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                </button>
                <span class="menu-text">Withdrawal Requests</span>
            </div>
            <!-- row begins -->
            <div class="row">
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">withdrawals approved</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $approvedWithdrawal ?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">withdrawals pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pendingWithdrawal ?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">withdrawals declined</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $declinedWithdrawal ?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			
            <div class="col-md-8">
 				<h2>Reward Requests</h2>
				<?php $count = 0; ?>
				<?php if ($rewardRequests): ?>
 					<?php foreach ($rewardRequests as $value) : ?>
				 	<?php $count++; ?>
					 <div class="card">
						<div class="card-header text-muted"><?= $count ?></div>
						<div class="card-body">
							<table class="table table-borderless table-sm table-responsive-sm">
								<tbody>
									<tr>
										<td>
											<strong>Code:</strong>
										</td>
										<td><?=$value->card_number?></td>
									</tr>
									<tr>
										<td>
											<strong>Name:</strong>
										</td>
										<td><?=$value->surname . ' ' . $value->firstname?></td>
									</tr>
									<tr>
										<td>
											<strong>Amount:</strong>
										</td>
										<td><?=number_format($value->amount , 2, '.', ',')?></td>
									</tr>
									<tr>
										<td>
											<strong>Date:</strong>
										</td>
										<td><?= date('F j Y', strtotime($value->request_date))?></td>
									</tr>
								</tbody>
							</table>
							<a href="<?php echo base_url(); ?>admin/withdrawal_request/response/<?=$value->user_id ?>/approve/reward" class="btn btn-primary">Approve</a>
							<a href="<?php echo base_url(); ?>admin/withdrawal_request/response/<?=$value->user_id ?>/decline/reward" class="btn btn-danger">Decline</a>
						</div>
					</div>
					 
					<?php endforeach; ?>
				<?php else: ?>
 					<p>There are no reward requests</p>
				<?php endif; ?>

				<h2>Referral Requests</h2>
				<?php $count = 0; ?>
				<?php if ($referralRequests): ?>
 					<?php foreach ($referralRequests as $value) : ?>
				 	<?php $count++; ?>
					 <div class="card">
						<div class="card-header text-muted"><?= $count ?></div>
						<div class="card-body">
							<table class="table table-borderless table-sm table-responsive-sm">
								<tbody>
									<tr>
										<td>
											<strong>Code:</strong>
										</td>
										<td><?=$value->card_number?></td>
									</tr>
									<tr>
										<td>
											<strong>Name:</strong>
										</td>
										<td><?=$value->surname . ' ' . $value->firstname?></td>
									</tr>
									<tr>
										<td>
											<strong>Amount:</strong>
										</td>
										<td><?=number_format($value->amount , 2, '.', ',')?></td>
									</tr>
									<tr>
										<td>
											<strong>Date:</strong>
										</td>
										<td><?= date('F j Y', strtotime($value->request_date))?></td>
									</tr>
								</tbody>
							</table>
							<a href="<?php echo base_url(); ?>admin/withdrawal_request/response/<?=$value->user_id ?>/approve/referral" class="btn btn-primary">Approve</a>
							<a href="<?php echo base_url(); ?>admin/withdrawal_request/response/<?=$value->user_id ?>/decline/referral" class="btn btn-danger">Decline</a>
						</div>
					</div>
					 
					<?php endforeach; ?>
				<?php else: ?>
 					<p>There are no Referral requests</p>
				<?php endif; ?>

            </div>

            <!-- row ends -->
        </div>

    </div>
