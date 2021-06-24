
<!DOCTYPE html>
<html>
<title>Dashboard</title>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="mystyletest.css">
<link rel="stylesheet" type="text/css" href="mychart.css">

<!-- Header -->
<?php include 'headerFooter.php';
echo "$header";?>
<!-- Headter ends -->

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
	<li><a class="active" href="Dashboard.php">Dashboard</a></li>
	<li><a href="DashboardTechnical.php">Dashboard Technical</a></li>
	<li><a href="DashboardMaintenance.php">Dashboard Maintenance</a></li>
	<li><a href="zone.php">Submit Issue</a></li>
	<li><a href="#">Manage Issues</a>
      <ul>
        <li><a href="assignIssues.php">Assign Issues</a></li>
        <li><a href="manageIssues.php">Update Issues</a></li>
      </ul>
    </li>
</ul>
 
 <!-- Part of user login display name cont. -->
 	<a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red; float: right; margin-right: 10px;">logout</a>
    <a style="font-size: 18px; float: right;" >Welcome: &nbsp;&nbsp; <strong style="text-transform: capitalize"><?php echo $_SESSION['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;</strong></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
  </div> 
</nav>
<!-- Menubar end -->
<br>  
  
<br>  

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="mychart.css">


<br>


<body>

<div class="navbar">
 <h1 style=" text-align : center; color: white">Technical Issues Status Report</h1>
</div>

</body>

<br>
<div id="flexbox">
	<div id="piechart">


<script type="text/javascript"
    src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">  
// API initialization to create Google chart 
</script>
</head>

<?php
$connect = mysqli_connect("localhost", "root", "asukuruk", "ITcapstone");
$query = "SELECT issueStatus, count(*) as statusCount FROM reported_issues WHERE issuesCategory = 'Technical' GROUP BY issueStatus;";
$result = mysqli_query($connect, $query);
$i=0;
while ($row = mysqli_fetch_array($result)) {
    $label[$i] = $row["issueStatus"];
    $count[$i] = $row["statusCount"];
    $i++;
}
?>


<script>
google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawPieChart);  

function drawPieChart()  
{  
    var pie = google.visualization.arrayToDataTable([  
              ['IssueStatus', 'Numbder'],
              ['<?php echo $label[0]; ?>', <?php echo $count[0]; ?>],
              ['<?php echo $label[1]; ?>', <?php echo $count[1]; ?>],
			  ['<?php echo $label[2]; ?>', <?php echo $count[2]; ?>],
			  ['<?php echo $label[3]; ?>', <?php echo $count[3]; ?>],
			  ['<?php echo $label[4]; ?>', <?php echo $count[4]; ?>],
			  ['<?php echo $label[5]; ?>', <?php echo $count[5]; ?>]
                    
         ]);  
    var header = {  
          title: 'Percentage of Reported Issues Status',
		  'width':680,
          'height':450,
		  slices: {0: {color: 'red'}, 1:{color: 'orange'}, 2:{color: 'gold'}, 3:{color: 'blue'}, 4:{color: 'yellow'}, 5:{color: 'green'}}
         };  
    var piechart = new google.visualization.PieChart(document.getElementById('piechart'));  
    piechart.draw(pie, header); 

}
</script>
		
 </div>
 
  
<div id="columnchart">

<script>
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawColumnChart);

function drawColumnChart() {
    var bar = google.visualization.arrayToDataTable([
           ['IssueStatus','Number',{ role: "style" } ],
		   ['<?php echo $label[5]; ?>', <?php echo $count[5]; ?>,"green"],
		   ['<?php echo $label[4]; ?>', <?php echo $count[4]; ?>,"yellow"],
		   ['<?php echo $label[3]; ?>', <?php echo $count[3]; ?>,"blue"],
		   ['<?php echo $label[2]; ?>', <?php echo $count[2]; ?>,"gold"],
           ['<?php echo $label[1]; ?>', <?php echo $count[1]; ?>,"orange"],
           ['<?php echo $label[0]; ?>', <?php echo $count[0]; ?>,"red"]
           ]);
    var columnview = new google.visualization.DataView(bar);
     columnview.setColumns([0, 1,
               { calc: "stringify",
                 sourceColumn: 1,
                 type: "string",
                 role: "annotation",
				 },
               2]);       
    var header = {
    title: 'Status Count', 
	'width':680,
    'height':450,
	bar: {groupWidth: "50%"}
    };
	
    var barchart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
    barchart.draw(columnview, header);
}

</script>

</div>
</div>

<br>

<body>

<div class="navbar" style="text-align: center">
  <a href="manageIssues.php"><i class="fa fa-fw fa-home"></i>Manage Issues</a> 
  <a href="zone.php"><i class="fa fa-fw fa-search"></i>Submit Issue</a> 
  <a href="IssuesHistory.php"><i class="fa fa-fw fa-envelope"></i>Issue History</a> 
</div>

</body>

<br>
<!-- Footer -->
<?php include 'headerFooter.php';
echo "$footer";?>
<!-- Footer ends -->

</html>