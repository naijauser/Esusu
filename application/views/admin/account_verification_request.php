<!-- Page Content  -->
<div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                </button>
                <span class="menu-text">Verification Requests</span>
            </div>
            <!-- row begins -->
            <div class="row">
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Accounts Approved</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$approvedCount?></div>
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
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">accounts pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$pendingCount?></div>
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">accounts declined</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$declinedCount?></div>
                                </div>
                                <div class="col-auto">
                                    <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
					<h2>Account Verification Requests</h2>
					<?php $count = 0; ?>
					<?php if ($verifyList): ?>
						<?php foreach ($verifyList as $value) : ?>
						<?php $count++; ?>
						<div class="card">
							<div class="card-header text-muted"><?= $count ?></div>
							<div class="card-body">
								<table class="table table-borderless table-sm table-responsive-sm">
									<tbody>
										<tr>
											<td>
												<strong>Card Number:</strong>
											</td>
											<td><?=$value->card_number?></td>
										</tr>
										<tr>
											<td>
												<strong>Username:</strong>
											</td>
											<td><?=$value->username?></td>
										</tr><tr>
											<td>
												<strong>Email:</strong>
											</td>
											<td><?=$value->email?></td>
										</tr>
										<tr>
											<td>
												<strong>Name:</strong>
											</td>
											<td><?=$value->surname . ' ' . $value->firstname?></td>
										</tr>
										<tr>
											<td>
												<strong>Phone Number:</strong>
											</td>
											<td><?='0'.$value->phone_number?></td>
										</tr>
										<tr>
											<td>
												<strong>Registration Date:</strong>
											</td>
											<td><?= date('F j Y', strtotime($value->request_date))?></td>
										</tr>
										<tr>
											<td>
												<strong>Proof of Payment:</strong>
											</td>
											<td>
												<a target="_blank" href="<?php echo base_url(); ?>uploads/<?=$value->payment_receipt?>">
													<img style="width: 150px;"src="<?php echo base_url(); ?>uploads/<?=$value->payment_receipt?>" alt="">
												</a>
											</td>
										</tr>
									</tbody>
								</table>
								<a href="<?php echo base_url(); ?>admin/account_verify_request/response/<?=$value->user_id ?>/approve" class="btn btn-primary">Approve</a>
								<a href="<?php echo base_url(); ?>admin/account_verify_request/response/<?=$value->user_id ?>/decline" class="btn btn-danger">Decline</a>
							</div>
						</div>
						
						<?php endforeach; ?>
					<?php else: ?>
						<p>There are no account verification requests</p>
					<?php endif; ?>
                </div>
                <!-- row ends -->
            </div>

        </div>
