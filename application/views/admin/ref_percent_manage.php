<div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                </button>
                <span class="menu-text">Manage Referral Percent</span>
            </div>
            <!-- row begins -->
            <div class="row">
                <div class="col-md-8">
					<form action="<?php echo base_url(); ?>admin/ref_percent_manage/updateData" method="POST" enctype="multipart/form-data">
					<?php $updateMessage = $this->session->flashdata('adm_ref_data_updated');?>
					<?php 
						if ($updateMessage) {
							echo '<div class="text-success">' . $updateMessage . '</div>'; 
						}
					?>
					<?php $bv_data = $this->session->flashdata('adm_ref_data');?>
						<div class="form-row">
							<div class="form-group col-3">
								<label for="">Level 1</label>
								<input type="text" name="lvl1" value="<?= $bv_data[0]->percent?>" class="form-control" placeholder="lvl1">
							</div>
							<div class="form-group col-3">
								<label for="">Level 2</label>
								<input type="text" name="lvl2" value="<?= $bv_data[1]->percent?>" class="form-control" placeholder="lvl2">
							</div>
							<div class="form-group col-3">
								<label for="">Level 3</label>
								<input type="text" name="lvl3" value="<?= $bv_data[2]->percent?>" class="form-control" placeholder="lvl3">
							</div>
							<div class="form-group col-3">
								<label for="">Level 4</label>
								<input type="text" name="lvl4" value="<?= $bv_data[3]->percent?>" class="form-control" placeholder="lvl4">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-3">
								<label for="">Level 5</label>
								<input type="text" name="lvl5" value="<?= $bv_data[4]->percent?>" class="form-control" placeholder="lvl5">
							</div>
							<div class="form-group col-3">
								<label for="">Level 6</label>
								<input type="text" name="lvl6" value="<?= $bv_data[5]->percent?>" class="form-control" placeholder="lvl6">
							</div>
							<div class="form-group col-3">
								<label for="">Level 7</label>
								<input type="text" name="lvl7" value="<?= $bv_data[6]->percent?>" class="form-control" placeholder="lvl7">
							</div>
							<div class="form-group col-3">
								<label for="">Level 8</label>
								<input type="text" name="lvl8" value="<?= $bv_data[7]->percent?>" class="form-control" placeholder="lvl8">
							</div>
							<div class="form-group col-3">
								<label for="">Level 9</label>
								<input type="text" name="lvl9" value="<?= $bv_data[8]->percent?>" class="form-control" placeholder="lvl9">
							</div>
							<div class="form-group col-3">
								<label for="">Level 10</label>
								<input type="text" name="lvl10" value="<?= $bv_data[9]->percent?>" class="form-control" placeholder="lvl10">
							</div>
						</div>
						<div class="form-row">
							<div class="col-2">
								<label for="">Exchange rate</label>
								<input type="text" name="rate" value="<?= $bv_data[10]->percent?>" class="form-control" placeholder="lvl1">
							</div>
						</div>
                        <button type="submit" class="btn btn-info mt-2">Update</button>
					</form>

				</div>
                <!-- row ends -->
            </div>
        </div>
    </div>
