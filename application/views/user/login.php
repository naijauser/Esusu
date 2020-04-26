<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Client Login</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    
		<style type = text/css>
			.form-signin {
				width: 100%;
				max-width: 330px;
				padding: 15px;
				margin: 0 auto;
			}		

			.text-danger {
				font-size: 14px;
			}
		</style>
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

</head>

<!-- <body class="text-center"> -->


  <body class="text-center">
    <form class="form-signin" action="<?php echo base_url(); ?>user/login/validate" method="POST" enctype="multipart/form-data">
      <!-- <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->
			<h1 class="h3 mb-3 font-weight-normal">Project Card</h1>
				<p>Please Sign In.</p>
				<?php 
					$loginMessage = $this->session->flashdata('loginMessage');
					$login_validation_errors = $this->session->flashdata('validation_errors');
				 ?>
			<?php echo '<div class="text-danger">' . $loginMessage . '</div>'; ?>
			<?php echo '<div class="text-danger">' . $login_validation_errors . '</div>'; ?>
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
			<p style="font-size: 14px">Don't have an account? <a href="<?php echo base_url(); ?>user/register">Register.</a></p>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy;<?php echo date("Y"); ?></p>
    </form>
  </body>
<!-- </body> -->

</html>
