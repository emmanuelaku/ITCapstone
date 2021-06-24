<!DOCTYPE html>
<html>


<head>
<title>Manage Users</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="mystyletest.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="custom.js"></script>
<style>b.indent{ padding-right: 20em }</style>

<header >
  <a href="http://ccse.kennesaw.edu/it"><img src="images/gt_logo.png" alt="gt logo" title="Click to open KSU site on a different tab"><br style="width:100px;height:800px:"></a>
</header>
<?php include('server.php') ?>

 <!-- Part of user login display name -->
 <?php 
//  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: index.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }
?>

  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
<!-- Part of user login display name ends --> 
	
<?php require_once('config.php'); ?>
  
<!--Menubar -->
   
<nav>
  <ul class="nav">
	<li><a href="Dashboard.php">Dashboard</a></li>
    <li><a class="active" href="#">Manage Users</a></li>
  </ul>
 <!-- Part of user login display name cont. -->
 	<a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red; float: right;">logout&nbsp;&nbsp;</a>
    <a style="font-size: 18px; float: right;" >Welcome: &nbsp;&nbsp; <strong style="text-transform: capitalize"><?php echo $_SESSION['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;</strong></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
  </div> 
</nav>
<!-- Menubar end -->
</head>
  
  
  <!--Sample area start-->


<head>
  <title>Manage Users</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
  <div style="width: 30%" class="header">
  	<h4>Add user</h4>
  </div>
	
  <form style="width: 30%" method="post" action="manageUsers.php" autocomplete="off">
  	<?php include('errors.php'); ?>
  	<div  class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>
  	<div  class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email">
  	</div>
	
	<div  class="input-group">
  	  <label>Role</label>
	 	<select name="role" id="role" >
			<option value=""selected>----</option>
			<option value="manager">Manager</option>
			<option value="technician">Technician</option>
			<option value="maintenance">Maintenance</option>
		</select>
  	</div>
	
  	<div  class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div  class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
		
	<p style="text-align: center" >
  		<a href="manageUsers.php">Reset</a>
  	</p>
	
  	<div style="text-align: center" class="input-group">
  	  <button style="background: Red" type="button" class="btn" name="cancel" value="cancel" onClick="window.location='dashboard.php';" />Cancel</button>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <button style="background: Darkblue" type="button" class="btn" name="link" value="link" onClick="window.location='listUsers.php';" />List user</button>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <button type="submit" class="btn" name="reg_user">Add user</button>
  	</div>
  
  </form>
</body>

<!--Sample area end-->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- Footer -->

<!-- Footer -->
<?php include 'headerFooter.php';
echo "$footer";?>
<!-- Footer ends -->

</html>