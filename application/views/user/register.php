<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Client Register</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
		crossorigin="anonymous">

	<style type = text/css>
		.form-register {
			width: 100%;
			max-width: 500px;
			padding: 15px;
			margin: 0 auto;
		}

			.text-danger {
				font-size: 14px;
			}

			.text-success {
				font-size: 14px;
			}
		</style>

  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

</head>

<!-- <body class="text-center"> -->

<body class="text-center">
  <h4>Registration</h4>
  <small>Start this journey with us</small>
	<hr>
	<?php $data = $this->session->flashdata('user_register_data');?>
	<?php 
			$exist_reg_error = $this->session->flashdata('exist_reg_error');
			$exist_reg_error2 = $this->session->flashdata('exist_reg_error2');
			$register_successful = $this->session->flashdata('register_successful');
			$validation_errors = $this->session->flashdata('validation_errors');
	
	?>
  <form class="form-register" action="<?php echo base_url(); ?>user/register/validate" method="POST" enctype="multipart/form-data">
	<?php if ($register_successful): ?>
		<?php echo '<div class="text-success">' . $register_successful . '</div>';?>
	<?php endif;?>
	<?php if ($exist_reg_error): ?>
				<?php echo '<div class="text-danger">' . $exist_reg_error . '</div>'; ?>
	<?php endif; ?>
	<?php if ($exist_reg_error2): ?>
				<?php echo '<div class="text-danger">' . $exist_reg_error2 . '</div>'; ?>
	<?php endif; ?>
	<?php echo '<div class="text-danger">' . $validation_errors . '</div>'; ?>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="surname">Surname</label>
        <input type="text" class="form-control" name="surname" id="surname" value="<?= $data['surname'] ? $data['surname'] : ''; ?>" required autofocus>
      </div>
      <div class="form-group col-md 6">
        <label for="firstname">First name</label>
        <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $data['firstname'] ? $data['firstname'] : ''; ?>" required>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?= $data['username'] ? $data['username'] : ''; ?>" required>
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="<?=$data['email'] ? $data['email'] : ''; ?>" required>
      </div>

    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="password" class="mr-sm-2">Password</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <div class="form-group col-md-6">
        <label for="password_confirm" class="mr-sm-2">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
      </div>

    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="address">Address</label>
        <input type="text" class="form-control" name="address" id="address" value="<?= $data['address'] ? $data['address'] : ''; ?>" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="state_of_residence">State Of Residence</label>
				<input class="form-control" list="state" name="state_of_residence">
				<datalist id="state">
					<option value="Abia">
					<option value="Abuja">
					<option value="Adamawa">
					<option value="Akwa Ibom">
					<option value="Anambra">
					<option value="Bauchi">
					<option value="Bayelsa">
					<option value="Benue">
					<option value="Borno">
					<option value="Cross River">
					<option value="Delta">
					<option value="Ebonyi">
					<option value="Enugu">
					<option value="Edo">
					<option value="Ekiti">
					<option value="Gombe">
					<option value="Imo">
					<option value="Jigawa">
					<option value="Kaduna">
					<option value="Kano">
					<option value="Katsina">
					<option value="Kebbi">
					<option value="Kogi">
					<option value="Kwara">
					<option value="Lagos">
					<option value="Nasarawa">
					<option value="Niger">
					<option value="Ogun">
					<option value="Ondo">
					<option value="Osun">
					<option value="Oyo">
					<option value="Plateau">
					<option value="Rivers">
					<option value="Sokoto">
					<option value="Taraba">
					<option value="Yobe">
					<option value="Zamfara">
				</datalist>
      </div>
      <div class="form-group col-md-6">
        <label for="phone">Phone Number</label>
        <input type="number" class="form-control" name="phone" id="phone" value="<?= $data['phone'] ? $data['phone'] : ''; ?>" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label class="mr-sm-2">Referrer Username</label>
        <input type="text" class="form-control" name='referrer' id="exampleInputPassword1"
					 value="<?php 
					 					if(isset($_GET['r'])) {
											$r = $_GET['r']; 
											echo $r;
										 } else if($data['referrer']) {
											 echo $data['referrer'];
										 } else {
											 echo '';
										 }
					 				 ?>" required>
      </div>
      <div class="form-group col-md-6">
        <label class="mr-sm-2">Gender</label>
        <select class="form-control mr-sm-2" name="gender" required>
          <option value="">Choose...</option>
          <option value="1">Male</option>
          <option value="2">Female</option>
        </select>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="exampleFormControlFile1" style="font-size: 12px;">Upload Payment evidence</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <input type="file" class="form-control-file" name="payment_proof" id="exampleFormControlFile1" required>
      </div>
      <div class="form-group col-md-6">
        <label class="mr-sm-2">Package</label>
        <select class="form-control mr-sm-2" name="package" required>
          <option value="">Choose...</option>
          <option value="1">Starter Pack ($26.32 USD)</option>
          <option value="2">Mind Pack ($52.63 USD)</option>
          <option value="3">Bold Pack ($131.58 USD)</option>
          <option value="4">Goal Pack ($263.16 USD)</option>
          <option value="5">Bronze Pack ($657.90 USD)</option>
          <option value="6">Silver Pack ($1315.78 USD)</option>
          <option value="7">Gold Pack ($2631.58 USD)</option>
        </select>
      </div>
    </div>
    <div class="g-recaptcha" data-sitekey="6LdrIpkUAAAAAJXMc3anrMAJmbd4XOiRr3dbWzVB"></div>
		<p style="font-size: 14px">Have an account? <a href="<?php echo base_url(); ?>user/login">Login.</a></p>
    <button type="submit" class="btn btn-info col-md-6">Submit</button>
  </form>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
<!-- </body> -->

</html>
