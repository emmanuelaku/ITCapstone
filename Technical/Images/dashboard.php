<!DOCTYPE html>


	<title>Home page</title>
	<meta charset="utf-8">

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
	<li><a class="active" href="Dashboard.php">Dashboard</a></li>
    <li><a href="#">Report an Issue</a>
      <ul>
        <li><a href="#">
	      <select id="zones">
            <option value="" selected>---Select Zone---</option>
             <?php $result = $conn->query("SELECT * FROM zones");
             while ($row = $result->fetch_assoc()){ ?>    <!-- onClick="openIssue(this)" to be inserted after the  zoneID ?>'' -->
            <option value="http://localhost/CapstoneProject/testground/Alabama.php" > <?php echo $row['zone']; ?></option>
			
            <?php } ?>
			
        </select>
 		</a></li>
        </ul>
    </li>
    
  </ul>
 
  
 <script>
    $('#zones').bind('change', function () { // bind change event to select
        var url = $(this).val(); // get selected value
        if (url != '') { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
</script>	 
 
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
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
    	<a style="font-size: 18px" >Welcome: &nbsp;&nbsp; <strong><?php echo $_SESSION['username']; ?></strong></a>&nbsp;&nbsp;&nbsp;&nbsp;
    	 <a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red">logout</a></b>
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
  </div> 
</nav>
<!-- Menubar end -->
<!--Menu Bar End-->

<br>
<br>

<!-- Database display test -->
<div id = "container">

<style>
table, th, td {
    border: 1px solid black;
}

th{
    text-transform: uppercase;
}


</style>


<?php
$host    = "localhost";
$user    = "root";
$pass    = "asukuruk";
$db_name = "ITcapstone";


//create connection
$connection = mysqli_connect($host, $user, $pass, $db_name);

//test if connection failed
if(mysqli_connect_errno()){
    die("connection failed: "
        . mysqli_connect_error()
        . " (" . mysqli_connect_errno()
        . ")");
}

//get results from database
$result = mysqli_query($connection,"SELECT * FROM reported_issues");
$all_property = array();  //declare an array for saving property

//showing property
echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
while ($property = mysqli_fetch_field($result)) {
    echo '<th>' . $property->name . '</th>';  //get field name for header
    array_push($all_property, $property->name);  //save those to array
}
echo '</tr>'; //end tr tag

//showing all data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    foreach ($all_property as $item) {
        echo '<td>' . $row[$item] . '</td>'; //get items using property value
    }
    echo '</tr>';
}
echo "</table>";
?>
</div>
<!-- Database display test -->

<br>
<br>            
<input type="submit" value="Submit">
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
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>





     
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>


	 
	 
	
<!-- Footer -->

<footer>

<h5>UNIVERSITY CONTACT INFOMATION</h5>

<div class="row">
  <div class="column">
    	
	<ol><b>Kennesaw Campus</b>					
		<br>1000 Chastain Road							
			Kennesaw, GA 30144								
			Phone: 470-578-6000	</a>
		
  </div>
  
  <div class="column">
    <a p> </p></a>
  </div>
  
  <div class="column">
  
	<ol> <b>Marietta Campus</b>
	<br>100 South Marietta Pkwy
		Marietta, GA 30060<br>
		Phone: 470-578-6000</a>
	
  </div>
</div>
<p> 2018 Kennesaw State University. This is a class project.</p>
</footer>

<!-- Footer ends -->


</HTML>