<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Marketing Compensation Plan</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
    crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/menu.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

</head>

<body>

  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header" style="background: white;">
        <h3 style="color: black;">Client</h3>
        <!-- <img src="logo1.png" alt="logo"> -->
      </div>

      <ul class="list-unstyled components">
        <li>
          <a href="<?php echo base_url(); ?>user/dashboard">Dashboard</a>
        </li>
        <!-- <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Menu</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">sub-menu1</a>
                            </li>
                            <li>
                                <a href="#">sub-menu2</a>
                            </li>
                            <li>
                                <a href="#">sub-menu3</a>
                            </li>
                        </ul>
                    </li> -->
        <li>
          <a href="<?php echo base_url(); ?>user/reward">Reward</a>
        </li>

        <li>
          <a href="<?php echo base_url(); ?>user/referral">Referral</a>
        </li>
        <!-- <li>
                        <a href="#">Contact Us</a>
                    </li> -->
        <li>
          <a href="<?php echo base_url(); ?>user/cashout_history">Cashout History</a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>user/profile">Profile</a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>user/logout">Logout</a>
        </li>
      </ul>
    </nav>
