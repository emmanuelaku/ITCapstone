
<!DOCTYPE html>
<html >
<title>Manage Issues</title>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="mystyletest.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php require_once('config.php'); ?>

<!--My header-->
<?php include 'headerFooter.php';
echo "$header";?>
<!--Header logo ends-->

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

<!--Menubar -->

<nav>
  <ul class="nav">
	<li><a href="Dashboard.php">Dashboard</a></li>
	<li><a href="zone.php">Submit Issue</a></li>
	<li><a class="active" href="ManageIssues.php">Manage Issues</a></li>
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
  	<h4>Update Issues Status</h4>
  </div>
<form style="width: 95%; border-radius: 0px 0px 0px 0px;" id="form1" name="form1" method="post" action="manageIssues.php">
<label for="from">Date search:</label>
<input style="width: 10%" name="from" type="text" id="from" size="10" value="<?php echo $_REQUEST["from"]; ?>" />

<label>String search:</label>
<input type="text" name="string" id="string" value="<?php echo stripcslashes($_REQUEST["string"]); ?>" />

<label>Issue Type:</label>
<select style="width: 15%" name="issueType">
<option value="">----</option>

<?php
	$sql = "SELECT * FROM ".$SETTINGS["data_table"]." GROUP BY issueType ORDER BY issueType";
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
  <a href="manageIssues.php">reset</a>
  <button style="background: Red; float: right;" type="button" class="btn" name="assign" value="assign" onClick="window.location='assignIssues.php';" />Assign Issues</button>
  
</form>

<br>
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
	<td width="9%" bgcolor="#CCCCCC"><strong>Issue Status</strong></td>
	<td width="15%" bgcolor="#CCCCCC"><strong>Update Status</strong></td>
	<td width="5%" bgcolor="#CCCCCC"><strong>Delete</strong></td>
	<td width="5%" bgcolor="#CCCCCC"><strong>Edit</strong></td>
  </tr>

<?php
if ($_REQUEST["string"]<>'') {
	$search_string = " AND (issueStatus LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%' OR lane LIKE '%".mysql_real_escape_string($_REQUEST["string"])."%')";	
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



$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
if (mysql_num_rows($sql_result)>0) {
	while ($row = mysql_fetch_assoc($sql_result)) {
?>

<!--onSelect code-->
   <script>
			$(document).ready(function(){
            $(".selectissueStatus").change(function(){
                // make jquery object that make reference to select in which click event is clicked
                $this = $(this);
                var issueStatusname = $(this).val();
                var getentryID = $(this).attr("issueStatus-entryID");
                //alert(displid);

                $.ajax({
                    type:'POST',
                    url:'ajaxreceiver.php',
                    data:{issueStatusname:issueStatusname,getentryID:getentryID},
                    success:function(result){
                        // this refer to the ajax callback function so we have to use $this which is initialized before ajax call
                        $($this).parents('tr').find("#display").html(result);
                    }
                });
            });
        });
    </script>
<!--onSelect code end-->

  <tr>
    <td><?php echo $row["entryID"]; ?></td>
    <td><?php echo $row["post_date"]; ?></td>
    <td><?php echo $row["dueDate"]; ?></td>
    <td ><?php echo $row["zone"]; ?></td>
	<td><?php echo $row["lane"]; ?></td>
    <td><?php echo $row["deviceType"]; ?></td>
    <td><?php echo $row["issueType"]; ?></td>
	
	<td><p id="display"><?php echo $row["issueStatus"];?></p></td>
                            <td>
                                <select name="issueStatus" issueStatus-entryID=<?php echo $row["entryID"];?> id="selectissueStatus" class="selectissueStatus">
                                    <option value="" selected> ---- </option>
									<option>Acknowledged</option>
                                    <option>Inspected</option>
                                    <option>Processing</option>
                                    <option>Resolved</option>
									<option>Escalated</option>
									<option>No Issue Found</option>
								</select>
							</td>

	<td><a href="deleteIssues.php?id=<?php echo $row["entryID"];?>">Delete</a></td>
	<td><a href="editIssues.php?id=<?php echo $row["entryID"];?>">Edit</a></td>
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

<?php
function getdata($issueStatusentryID,$entryID){
            $sql = $this->link->stmt_init();
            if($sql->prepare("UPDATE reported_issues SET issueStatus=? WHERE entryID=?")){
                $sql->bind_param('si',$issueStatusentryID,$entryID);
                if($sql->execute()){
                    echo $issueStatusentryID;

                }
                else
                {
                    echo "Update Failed";
				}
            }
        }
?>


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

<!-- Footer -->

<?php include 'headerFooter.php';
echo "$footer";?>

<!-- Footer ends -->

</HTML>