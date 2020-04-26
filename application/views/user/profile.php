<!-- Page Content  -->
<div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="<?php echo base_url(); ?>assets/img/nav.png" alt="Menu">
                </button>
                <span class="menu-text">Profile</span>
            </div>
            <!-- row begins -->
            <div class="row">
                <div class="col-md-8">
					<?php 
						$data = $this->session->flashdata('user_profile_data');
						$success = $this->session->flashdata('success');
						$error = $this->session->flashdata('error');
					?>
					<strong>Your Referral link is:</strong> <?php echo base_url(); ?>user/register?r=<?=$data['username']?>
					<hr>
					<br>
					<h4>Edit Profile details</h4>
                    <form action="<?php echo base_url(); ?>user/profile/update" method="POST" enctype="multipart/form-data">
					<?php if ($success): ?>
						<?php echo '<div class="text-success" style="font-size:14px;">' . $success . '</div>';?>
					<?php endif;?>
					<?php if ($error): ?>
							<?php echo '<div class="text-danger" style="font-size:14px;">' . $error . '</div>'; ?>
					<?php endif; ?>
                        <div class="form-row">
                            <div class="form-group col-md 6">
                                <label for="firstName">Email</label>
                                <input type="email" class="form-control" name="email" id="firstName" value="<?= $data['email'] ? $data['email'] : ''; ?>" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Phone number</label>
                                <input type="number" class="form-control" name="phone" id="middleName" value="<?= $data['phone_number'] ? $data['phone_number'] : ''; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="account_name">Account Name</label>
                                <input type="text" class="form-control" name="account_name" id="account_name" value="<?= $data['accountname'] ? $data['accountname'] : ''; ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="account_number">Account Number</label>
                                <input type="number" class="form-control" name="account_number" id="account_number" value="<?= $data['account_number'] ? $data['account_number']  : ''; ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank">Bank</label>
                                <input type="text" class="form-control" name="bank" id="bank" value="<?= $data['bank']  ? $data['bank'] : ''; ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>

					<?php 
						$success2 = $this->session->flashdata('success2');
						$error2 = $this->session->flashdata('error2');
					?>
                    <form action="<?php echo base_url(); ?>user/profile/updatePassword" method="POST" enctype="multipart/form-data">
                        <hr>
                        <h4>Change Password</h4>
						<?php $validation_errors = $this->session->flashdata('profile_validation_errors') ?>
						<?php echo '<div class="text-danger profile-error">' . $validation_errors . '</div>'; ?>
						<?php if ($success2): ?>
							<?php echo '<div class="text-success" style="font-size:14px;">' . $success2 . '</div>';?>
						<?php endif;?>
						<?php if ($error2): ?>
								<?php echo '<div class="text-danger" style="font-size:14px;">' . $error2 . '</div>'; ?>
						<?php endif; ?>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="enter new password" required>
                            </div>
                            <div class="form-group col-md-4">
                                <input type="password" class="form-control" name="password_confirm" id="exampleInputPassword1" placeholder="confirm new password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
                <!-- row ends -->
            </div>
        </div>

    </div>
