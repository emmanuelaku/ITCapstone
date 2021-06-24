<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Issues History</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="mystyletest.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="custom.js"></script>
<style>b.indent{ padding-right: 20em }</style>


<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>



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
	<li><a href="dashboard.php">Dashboard</a></li>
	<li><a href="zone.php">Submit Issue</a></li>
	<li><a class="active" href="issuesHistory.php">Issues History</a></li>
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
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
    	<a style="font-size: 18px" >Welcome: &nbsp;&nbsp; <strong style="text-transform: capitalize" ><?php echo $_SESSION['username']; ?></strong></a>&nbsp;&nbsp;&nbsp;&nbsp;
    	 <a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red">logout</a></b>
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
  </div> 
</nav>
<!-- Menubar end -->
<!--Menu Bar End-->
</head>


<div id = "container">
<?php

error_reporting(0);
include("config.php");
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
<button style="background: Red; float: right" type="button" class="btn" name="cancel" value="cancel" onClick="window.location='dashboard.php';" />Exit</button>
  	<h4>Issues Listing</h4>
  </div>
<form style="width: 95%; border-radius: 0px 0px 0px 0px;" id="form1" name="form1" method="post" action="issuesHistory.php">
<label for="from">Posted Date:</label>
<input style="width: 10%" name="from" type="text" id="from" size="10" value="<?php echo $_REQUEST["from"]; ?>" />


<label>Lane or Device Type:</label>
<input type="text" name="string" id="string" value="<?php echo stripcslashes($_REQUEST["string"]); ?>" />

<label>Issue Type:</label>
<select style="width: 15%" name="issueType">
<option value="">----</option>

<?php
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." GROUP BY issueType ORDER BY issueType ";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	while ($row = mysql_fetch_assoc($sql_result)) {
		echo "<option value='".$row["issueType"]."'".($row["issueType"]==$_REQUEST["issueType"] ? " selected" : "").">".$row["issueType"]."</option>";
	}
?>
</select>

<label>Zone:</label>
<select style="width: 15%" name="zone">
<option value="">----</option>

<?php
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." GROUP BY zone ORDER BY zone";
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
	while ($row = mysql_fetch_assoc($sql_result)) {
		echo "<option value='".$row["zone"]."'".($row["zone"]==$_REQUEST["zone"] ? " selected" : "").">".$row["zone"]."</option>";
	}
?>
</select>
&nbsp;&nbsp;&nbsp;
<input type="submit" class="btn" name="button" id="button" value="Search" />
  </label>
  &nbsp;&nbsp;&nbsp;
  <a href="issuesHistory.php">reset</a>
 
</form>

<br>


<?php

$record_per_page = 10;
$page = '';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}

$start_from = ($page-1)*$record_per_page;

//$sql = "SELECT * FROM reported_issues $search_string $search_issueType LIMIT $start_from, $record_per_page";

if ($_REQUEST["string"]<>'') {
	$search_string = " AND (issueStatus LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR assignTo LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR issueType LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR lane LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";	
}
if ($_REQUEST["issueType"]<>'') {
	$search_issueType = " AND issueType='".mysql_real_escape_string($_REQUEST["issueType"])."'";	
}

if ($_REQUEST["zone"]<>'') {
	$search_issueType = " AND zone='".mysql_real_escape_string($_REQUEST["zone"])."'";	
}

if ($_REQUEST["from"]<>'' and $_REQUEST["to"]<>'') {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE dueDate >= '".mysql_real_escape_string($_REQUEST["from"])."' AND to_date <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_string.$search_issueType;
} else if ($_REQUEST["from"]<>'') {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE dueDate >= '".mysql_real_escape_string($_REQUEST["from"])."'".$search_string.$search_issueType;
} else if ($_REQUEST["to"]<>'') {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE to_date <= '".mysql_real_escape_string($_REQUEST["to"])."'".$search_string.$search_issueType;
} else {
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE entryid>0".$search_string.$search_issueType;
}

//Pagination

$connect = mysqli_connect("localhost", "root", "asukuruk", "ITcapstone");
//	$sql = "SELECT * FROM reported_issues ORDER BY entryID LIMIT $start_from, $record_per_page";

//Stoped part of pagination

//$sql_result = mysqli_query($connection, $sql);

?>
<form style="width: 95%">
<table width="90" border="1" cellspacing="0" cellpadding="4">
  <tr>
    <td width="6%" bgcolor="#CCCCCC"><strong>ID</strong></td>
	<td width="8%" bgcolor="#CCCCCC"><strong>Posted Date</strong></td>
	<td width="6%" bgcolor="#CCCCCC"><strong>Due Date</strong></td>
    <td width="15%" bgcolor="#CCCCCC"><strong>Zone</strong></td>
    <td width="10%" bgcolor="#CCCCCC"><strong>Lane</strong></td>
    <td width="15%" bgcolor="#CCCCCC"><strong>Device Type</strong></td>
	<td width="15%" bgcolor="#CCCCCC"><strong>Issue Type</strong></td>
	<td width="9%" bgcolor="#CCCCCC"><strong>Issues Status</strong></td>
	<td width="9%" bgcolor="#CCCCCC"><strong>Assigned To</strong></td>
</tr>
<?php

//Part of the search engine codes (use to populate the table)
$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
if (mysql_num_rows($sql_result)>0) {
	while ($row = mysql_fetch_assoc($sql_result)) {
?>



<tr>
    <td><?php echo $row["entryID"]; ?></td>
    <td><?php echo $row["post_date"]; ?></td>
    <td><?php echo $row["dueDate"]; ?></td>
    <td ><?php echo $row["zone"]; ?></td>
	<td><?php echo $row["lane"]; ?></td>
    <td><?php echo $row["deviceType"]; ?></td>
    <td><?php echo $row["issueType"]; ?></td>
	<td><?php echo $row["issueStatus"]; ?></td>
	<td><?php echo $row["assignTo"]; ?></td>
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

<style>
 .pagination a {
  color: black;
  float: center;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
}

.pagination a.active {
  background-color: dodgerblue;
  color: white;
}

.pagination a:hover:not(.active) {background-color: blue;}
</style>


 <br/>
<!--Part of pagination codes-->
<div  align="center" class = "pagination">

   
<?php
   //$sql = "SELECT COUNT(*) FROM reported_issues".$search_string.$search_issueType;
   $sql = "SELECT * FROM reported_issues ORDER BY entryID";
 //   $page_result = mysqli_query($connect, $page_query);
	$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
    $total_records = mysql_num_rows($sql_result);
    $total_pages = ceil($total_records/$record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 5)
    {
     $start_loop = $total_pages - 5;
    }
    $end_loop = $start_loop + 4;
    if($page > 1)
    {
     echo "<a href='issuesHistory.php?page=1'>First</a>";
     echo "<a href='issuesHistory.php?page=".($page - 1)."'><<</a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     
     echo "<a href='issuesHistory.php?page=".$i."'>".$i."</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a href='issuesHistory.php?page=".($page + 1)."'>>></a>";
     echo "<a href='issuesHistory.php?page=".$total_pages."'>Last</a>";
    }

    ?>
</div>
 

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

<br>
<br>

<!-- Footer -->

<!-- Footer using php -->

<?php include 'headerFooter.php';
echo "$footer";?>
	
<!-- End footer -->

<!-- Footer ends -->

</html>