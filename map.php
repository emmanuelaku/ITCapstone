<!DOCTYPE html>
<html>
<title>Issues Location</title>

<?php require_once('config.php'); ?>

<!--My header-->
<?php include 'headerFooter.php';
echo "$header";?>
<!--Header logo ends-->

<!--Menubar -->
<nav>
  <ul class="nav">
	<li><a href="dashboard.php">Dashboard</a></li>
	<li><a class="active" href="zone.php">Submit Issue</a></li>
	<li><a href="manageIssues.php">Manage Issues</a></li>
  </ul>
<!--Menu Bar End-->

<!-- Part of user login display name and session -->
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
	<a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red; float: right;">logout&nbsp;&nbsp;</a>
    <a style="font-size: 18px; float: right;" >Welcome: &nbsp;&nbsp; <strong style="text-transform: capitalize"><?php echo $_SESSION['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;</strong></a>
    &nbsp;&nbsp;&nbsp;&nbsp;	 
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
</nav>
<!--Menu header ends-->

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

<!-- Footer using php -->

<?php include 'headerFooter.php';
echo "$footer";?>
	
<!-- End footer -->

</html>