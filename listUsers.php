<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Users</title>
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

<?php require_once('configUsers.php'); ?>
  
<!--Menubar -->
   
   
<nav>
  <ul class="nav">
	<li><a href="dashboard.php">Dashboard</a></li>
	<li><a href="zone.php">Submit Issue</a></li>
	<li><a class="active" href="IssuesHistory.php">Issues History</a></li>
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

<div id = "container">
<?php

error_reporting(0);
include("configUsers.php");
?>

<style>
BODY, TD {
	font-family:Arial, Helvetica, sans-serif;
	font-size:15px;
}
</style>
<!--Search header-->
<body>

<h5>Type or select to search</h5>

<div style="width: 95%" class="header">
<button style="background: Red; float: right;" type="button" class="btn" name="cancel" value="cancel" onClick="window.location='dashboard.php';" />Exit</button>
  	<h4>User listing</h4>
  </div>
<form style="width: 95%; border-radius: 0px 0px 0px 0px;" id="form1" name="form1" method="post" action="listUsers.php">
<label for="from">Reg Date:</label>
<input style="width: 10%" name="from" type="text" id="from" size="10" value="<?php echo $_REQUEST["from"]; ?>" />


<label>User Name/Email:</label>
<input type="text" name="string" id="string" value="<?php echo stripcslashes($_REQUEST["string"]); ?>" />

<label>Role:</label>
<select style="width: 15%" name="role">
<option value="">----</option>

<?php
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." GROUP BY role ORDER BY role ";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	while ($row = mysql_fetch_assoc($sql_result)) {
		echo "<option value='".$row["role"]."'".($row["role"]==$_REQUEST["role"] ? " selected" : "").">".$row["role"]."</option>";
	}
?>
</select>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" class="btn" name="button" id="button" value="Search" />
  </label>
  &nbsp;&nbsp;
  <a href="listUsers.php">reset</a>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  
   <button style="background: darkblue" type="button" class="btn" name="link" value="link" onClick="window.location='manageUsers.php';" />Add User</button>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  
</form>

<br>
<form style="width: 95%">
<table width="90" border="1" cellspacing="0" cellpadding="4">
  <tr>
    <td width="6%" bgcolor="#CCCCCC"><strong>ID</strong></td>
	<td width="8%" bgcolor="#CCCCCC"><strong>Reg Date</strong></td>
	<td width="15%" bgcolor="#CCCCCC"><strong>User Name</strong></td>
    <td width="10%" bgcolor="#CCCCCC"><strong>Email</strong></td>
    <td width="15%" bgcolor="#CCCCCC"><strong>Role</strong></td>
	
	<td width="5%" bgcolor="#CCCCCC"><strong>Delete</strong></td>
	<td width="5%" bgcolor="#CCCCCC"><strong>Edit</strong></td>
  </tr>

  
  
  
  
<?php
if ($_REQUEST["string"]<>'') {
	$search_string = " AND (username LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR role LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";	
}
if ($_REQUEST["role"]<>'') {
	$search_role = " AND role='".mysql_real_escape_string($_REQUEST["role"])."'";	
}

//if ($_REQUEST["zone"]<>'') {
//	$search_issueType = " AND zone='".mysql_real_escape_string($_REQUEST["zone"])."'";	
//}

if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'') {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE regDate >= '".mysql_real_escape_string($_REQUEST["from"])."' AND to_date <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_string.$search_role;
} else if ($_REQUEST["from"]<>'') {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE regDate >= '".mysql_real_escape_string($_REQUEST["from"])."'".$search_string.$search_role;
} else if ($_REQUEST["to"]<>'') {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE to_date <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_string.$search_role;
} else {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE id>0".$search_string.$search_role;
}

$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
if (mysql_num_rows($sql_result)>0) {
	while ($row = mysql_fetch_assoc($sql_result)) {
?>

  <tr>
    <td><?php echo $row["id"]; ?></td>
    <td><?php echo $row["regDate();"]; ?></td>
    <td ><?php echo $row["username"]; ?></td>
	<td><?php echo $row["email"]; ?></td>
    <td><?php echo $row["role"]; ?></td>
    	
	<td><a href="deleteUsers.php?id=<?php echo $row["id"];?>">Delete</a></td>
	<td><a href="editUsers.php?id=<?php echo $row["id"];?>">Edit</a></td>
  </tr>
  
<?php
	}
} else {
?>
<tr><td colspan="5">No results found.</td>
<?php	
}
?>
</table>
</form>




<script>
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 2,
			dateFormat: 'yy-mm-dd',
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	</script>

</body>

</div>


<br><br>
<!-- Database display test -->

<!-- Database display test -->            




  

     
<style>
table {
    width: 95%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>


	 
	 
	
<!-- Footer -->
<?php include 'headerFooter.php';
echo "$footer";?>
<!-- Footer ends -->


</HTML>