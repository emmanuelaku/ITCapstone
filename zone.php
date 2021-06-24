<?php

// start/resume session

@session_start();

?>
<!DOCTYPE html>
<html>
<title>Zone</title>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="mystyletest.css">
<!-- Header using php -->
<?php include 'headerFooter.php';
echo "$header";?>
<!-- End Header -->

 <!--My header -->
 




<!-- Part of user login display name -->
 <?php 
  //session_start(); 

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
<nav>
  <ul class="nav">
	<li><a href="dashboard.php">Dashboard</a></li>
	<li><a class="active" href="zone.php">Submit Issue</a></li>
	<li><a href="manageIssues.php">Manage Issues</a></li>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</ul>
<!-- Part of user login display name cont. -->
 	<a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red; float: right; margin-right: 10px;">logout</a>
    <a style="font-size: 18px; float: right;" >Welcome: &nbsp;&nbsp; <strong style="text-transform: capitalize"><?php echo $_SESSION['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;</strong></a>
    
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
  </div> 
</nav>
<!-- Menubar end -->
</head>
 
 <!--My header ends-->

<style>
table, th, td {
    border: 1px solid black;
}
</style>

<body>
	

<br>
<br>
<br>
<br>

<body>
  <div style="width: 35%" class="header">
  	<h4>Zone selection</h4>
  </div>
 
<form style="width: 35%" method="post" name="form1" action="map.php"> <!-- changed action to take user to map page - Kyle -->

<div  class="input-group">

<?php
   $conn = new mysqli("localhost", "manager",

          "my*password", "ITcapstone");

      if (mysqli_connect_errno($conn)){

          echo 'Cannot connect to database: ' . mysqli_connect_error();

      }
?>
<label> Select Zone </label>

<select name= "zone" required>
<option value="" selected>---Select Zone---</option>
    <?php
         $query = "SELECT zoneID, zone, imgName from zones;";   // added "imgName" to query - Kyle
         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {  
    while($row = mysqli_fetch_array($result)){
     
    echo "<option value={$row['imgName']}>{$row['zone']}</option>" ; // changed value to associate with imgName -Kyle
    
    }

         }
?>     

  </select>
<br>
<br>
<div style="text-align: center" class="input-group">
<button style="background: Red" type="button" class="btn" name="cancel" value="cancel" onClick="window.location='dashboard.php';" />Cancel</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn" value="Submit">Submit</button>
</div>
</div>
</form>

</body>
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