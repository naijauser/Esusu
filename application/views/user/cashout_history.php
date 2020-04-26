<!-- Page Content  -->
<div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                </button>
                <span class="menu-text">Cashout History</span>
            </div>
            <!-- row begins -->
            <div class="row">
                <div class="col-md-8">

					<?php if (empty($cashout_array)) :?>
						<p>You have not made any cashouts yet.</p>
					<?php else : ?>
						<div class="card" style="margin-bottom: 10px;">
							<div class="card-body">
								<table class="table table-sm table-responsive-sm">
									<thead>
										<tr>
											<th scope="col">Amount(N)</th>
											<th scope="col">Request Date</th>
											<th scope="col">Approval Date</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($cashout_array as $value) : ?>
											<tr>
												<td><?= number_format((double)$value->amount , 2, '.', ',') ?></td>
												<td><?= date('F j Y', strtotime($value->request_date)) ?></td>
												<td><?= date('F j Y', strtotime($value->approval_date)) ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					<?php endif;?>
                </div>

                <!-- row ends -->
            </div>
        </div>


    </div>
