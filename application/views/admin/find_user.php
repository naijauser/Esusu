<!-- Page Content  -->
<div id="content">
                <div class="menu-header">
                    <button type="button" id="sidebarCollapse" class="btn menu-btn">
                        <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                    </button>
                    <span class="menu-text">Manage User</span>
                </div>
                <!-- row begins -->
                <div class="row">
                    <div class="col-md-8">
                        <form class="form-inline" action="<?php echo base_url(); ?>admin/find_user/find" method="POST" enctype="multipart/form-data">
                            <div class="form-group mb-2">
                                <label for=""></label>
                                <input type="text" class="form-control" name="code" id="" aria-describedby="helpId" placeholder="Enter Card Number">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Search</button>
                        </form>
                        <div class="card" style="margin-bottom: 10px;">
                            <!-- <div class="card-header text-muted">Details</div> -->

							<?php $user_data = $this->session->flashdata('adm_user_data');?>
								<?php if (is_array($user_data)) :?>
									<?php $user_data = $user_data[0]; ?>
									<div class="card-body">
										<table class="table table-borderless table-sm table-responsive-sm table-striped">
											<tbody>
												<tr>
													<td>
														<strong>Card Number:</strong>
													</td>
													<td><?= $user_data->card_number?></td>
												</tr>
												<tr>
													<td>
														<strong>Name:</strong>
													</td>
													<td><?= $user_data->surname . ' ' . $user_data->firstname?></td>
												</tr>
												<tr>
													<td>
														<strong>Username:</strong>
													</td>
													<td><?=$user_data->username ?></td>
												</tr>
												<tr>
													<td>
														<strong>Email:</strong>
													</td>
													<td><?=$user_data->email ?></td>
												</tr>
												<tr>
													<td>
														<strong>Phone Number:</strong>
													</td>
													<td><?=$user_data->phone_number ?></td>
												</tr>
												<tr>
													<td>
														<strong>Account Status:</strong>
													</td>
													<td><?=$user_data->account_status ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								<?php endif; ?>
								<?php if ($user_data == 'empty') :?>
									<p>User not found! Please check the card number and try again!.</p>
								<?php endif; ?>
                        </div>
                        <!-- row ends -->
                    </div>
                </div>
            </div>
