<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type = "text/css" href="map.css">
</head>

 <!--My header -->
 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Issues</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="mystyletest.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="custom.js"></script>
<style>b.indent{ padding-right: 20em }</style>

<header>
  <a href="http://ccse.kennesaw.edu/it"><img src="images/gt_logo.png" alt="ksu logo" title="Click to open KSU site on a different tab"><br style="width:100px;height:800px:"></a>
</header>

 <!-- Part of user login display name -->
 <?php 
  session_start(); 

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
	<li><a href="dashboardTechnical.php">Dashboard Technical</a></li>
	<li><a class="active" href="zone.php">Submit Issue</a></li>
	<li><a href="manageIssues.php">Manage Issues</a></li>
  </ul>
  
 <!-- Part of user login display name cont. -->
 <!-- I needed space here-->
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	
	
	
    	<a style="font-size: 18px" >Welcome: &nbsp;&nbsp; <strong style="text-transform: capitalize"><?php echo $_SESSION['username']; ?></strong></a>&nbsp;&nbsp;&nbsp;&nbsp;
    	 <a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red">logout</a></b>
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
  </div> 
</nav>
<!-- Menubar end -->
<!--Menu Bar End-->
</head>
 
 <!--My header ends-->


<body>

<h2>
Please select the location of the issue on the map below.
</h2>

<body>
  <div style="width: 58%" class="header">
  	<h4>Zone selection</h4>
  </div>

<form style="width: 58%" action="newissue.php" method="post">

	<input type="hidden" id="zone" name="zone" value="<?php echo $_POST['zone'] ?>">
	X coordinate: <input type="text" id="xcoord" name="xcoord" readonly>
	Y coordinate: <input type="text" id="ycoord" name="ycoord" readonly>
&nbsp;&nbsp;&nbsp;

<button style="background: Red" type="button" class="btn" name="cancel" value="cancel" onClick="window.location='zone.php';" />Cancel</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn" value="Submit">Submit</button>


<div  class="input-group">
<div id="contentContainer">
    <img id="map" src="img/<?php echo $_POST['zone'] ?>.png"> <!-- map image -->
    <img id="dot" src="img/dot.png" width=1%> <!-- red dot -->
</div>
</div>
</form>
</body>	

	<script src="map.js"></script>

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
<br>
<br>
<br>
<br>
<br>
<br>


<!-- Footer using php -->

<?php include 'headerFooter.php';
echo "$footer";?>
	
<!-- End footer -->

</html>