<?php

// start/resume session

@session_start();

?>
<!doctype html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
<link href="ITCapstone.css" rel="stylesheet" type="text/css">
<title>submitIssue_action.php</title>

 <!--My header -->
 
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" type="text/css" href="mystyletest.css">
<script type="text/javascript" src="custom.js"></script>
<style>b.indent{ padding-right: 20em }</style>

<header>
  <a href="http://ccse.kennesaw.edu/it"><img src="images/gt_logo.png" alt="ksu logo" title="Click to open KSU site on a different tab"><br style="width:100px;height:800px:"></a>
</header>

 <!-- Part of user login display name -->
 <?php 
 // session_start(); 

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

</head>
<body>	

<br>
<br>
<br>
<br>
<br>
<br>
<div  class="input-group">	  
<?php

   $conn = new mysqli("localhost", "manager",

          "my*password", "ITCapstone");

      if (mysqli_connect_errno($conn)){

          echo 'Cannot connect to database: ' . mysqli_connect_error();

      }


   $all_information_provided = 1;

		
	
	
  if(!empty($_POST['zone'])){

    //read all provided values as an array and join them as comma separated string 

    $zone = $_POST['zone'];
 


  } else {

    echo "<p>No Zone Selected.</p>";
    $all_information_provided = 0;
  }
  
  if(!empty($_POST['lane'])){

    //read all provided values as an array and join them as comma separated string 

    $lane = $_POST['lane'];
 

  } else {

    echo "<p>No lane selected.</p>";
    $all_information_provided = 0;
  }
   
 
  
  
  
 if(!empty($_POST['device'])){

    //read all provided values as an array and join them as comma separated string 

    $device = $_POST['device'];
 

  } else {

    echo "<p>No device selected.</p>";
    $all_information_provided = 0;
  }
 
 if(!empty($_POST['issue'])){

    //read all provided values as an array and join them as comma separated string 

    $issue = $_POST['issue'];
 

  } else {

    echo "<p>No issue selected.</p>";
    $all_information_provided = 0;
  } 
  
  if(!empty($_POST['issuesCategory'])){

    //read all provided values as an array and join them as comma separated string 

    $issuesCategory = $_POST['issuesCategory'];


  } else {

    echo "<p>No issuesCategory selected.</p>";
    $all_information_provided = 0;
  }
  
  //We use the values of issuesCategory to populate the assignTo column
  if(!empty($_POST['issuesCategory'])){

    //read all provided values as an array and join them as comma separated string 

    $assignTo = $_POST['issuesCategory'];


  } else {

    echo "<p>No issuesCategory selected.</p>";
    $all_information_provided = 0;
  }
  
  
  
  
  if(!empty($_POST['datepicker'])){

    //read all provided values as an array and join them as comma separated string 

    $datepicker = $_POST['datepicker'];

  } else {

    echo "<p>No due date selected.</p>";
    $all_information_provided = 0;
  }
  

    $comment = $_POST['comment'];
 


if(!empty($_POST['xcoord'])){

    //read all provided values as an array and join them as comma separated string 

    $xcoord = $_POST['xcoord'];
 

  } else {

    echo "<p>No X coordinates selected.</p>";
    $all_information_provided = 0;
  }


if(!empty($_POST['ycoord'])){

    //read all provided values as an array and join them as comma separated string 

    $ycoord = $_POST['ycoord'];


  } else {

    echo "<p>No Y coordinates selected.</p>";
    $all_information_provided = 0;
  }
 
//Default value for issueStatus entry 
 $issueStatus = "Acknowledged";
 $post_date	= date("Y-m-d");


//if all required information was provided, we can insert

  //data in the database table

  //connect to the database

    if($all_information_provided == 1){

     $conn = mysqli_connect("localhost", "manager",

       "my*password", "ITCapstone")

        or die("Cannot connect to database:" .

           mysqli_connect_error($conn));



//create prepared statement to insert data in the serviceRequests table

 
      $query = mysqli_prepare($conn,
	 

    "INSERT INTO reported_issues (post_date, zone, lane, deviceType, issueType, issuesCategory, assignTo, issueStatus,
                                  dueDate, comment, xcoord, ycoord) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")

        or die("Error: ". mysqli_error($conn));

  	
 

   // bind parameters "s" - string

   mysqli_stmt_bind_param ($query, "ssssssssssss", $post_date, $zone, $lane, $device, $issue, $issuesCategory, $assignTo, $issueStatus,
          $datepicker, $comment, $xcoord, $ycoord);

      

   //run the query mysqli_stmt_execute returns true if the

   //query was successful

   mysqli_stmt_execute($query)

       or die("Error. Could not insert into the table."

                   . mysqli_error($conn));

 
   $inserted_id = mysqli_insert_id($conn);
   

   echo "You have submitted an issue successfully! It is entry \r\n #" . $inserted_id.
 //Display message for email
    " \n\n An email will be forwarded to the \r\n" .$issuesCategory. "\r\ngroup";
   
   header("refresh:10; url=dashboardTechnical.php");
					mysqli_stmt_close($query); 
					} else {
					echo "<p>All information is required, use back button and complete all required fields.</p>";
					header("refresh:3; url=zone.php");
					}
   
   //Code for sending email to various category based on selected issues category 
	switch($issuesCategory){

                case 'Technical':
				    $to = "emmanuelaku@gmail.com";
					$subject = "$issue";
					$message = " Hi, $issuesCategory group?
								\nPlease, be informed that, a fault have been reported as detailed below:
								\nFualt: $issue
								\nLocation: $zone,
								\nLane: $lane,
								\nDevice type: $device,
								\nComment: $comment";
					$headers = "From: emmanuelaku@gmail";
					mail($to, $subject, $message, $headers);
					echo("<p>Email successfully sent!</p>");
					exit();
                
                case 'Maintenance':
					 $to = "emmanuelaku@gmail.com";
					$subject = "$issue";
					$message = " Hi, $issuesCategory group?
								\nPlease, be informed that, a fault have been reported as detailed below:
								\nFualt: $issue
								\nLocation: $zone,
								\nLane: $lane,
								\nDevice type: $device,
								\nComment: $comment";
					$headers = "From: emmanuelaku@gmail";
					mail($to, $subject, $message, $headers);
					echo("<p>Email successfully sent!</p>");
					exit();

                default:
					echo("<p>Email delivery failed…</p>");
              }


?>
</div>
</body>
<!-- Footer using php -->

<?php include 'headerFooter.php';
echo "$footer";?>
	
<!-- End footer -->
</html>