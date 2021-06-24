<!DOCTYPE html>
<html>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Users</title>
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
	
    	<a style="font-size: 18px" >Welcome: &nbsp;&nbsp; <strong style="text-transform: capitalize"><?php echo $_SESSION['username']; ?></strong></a>&nbsp;&nbsp;&nbsp;&nbsp;
    	 <a href="dashboard.php?logout='1'"  style="font-size: 18px; color: red">logout</a></b>
    <?php endif ?>
 <!-- Part of user login display name cont. ends-->
  </div> 
</nav>
<!-- Menubar end -->
<!--Menu Bar End-->
</head>


<?php

/*

EDIT.PHP

Allows user to edit specific entry in database

*/

// creates the edit record form

function renderForm($id, $regDate, $username, $email, $role, $error)

{

?>



<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>


<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>


<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>
<body>
<div style="width: 30%" class="header">
	<h4>Edit User</h4>
</div>
  
<form style="width: 30%" method="post" action="">
<!-- <form action="" method="post"> -->
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div>
<div style="width: 30%" class="input-group">
<label>ID:</label><input type="text" name="id" value="<?php echo $id; ?>" readonly /><br/>
</div>

<div style="width: 30%" class="input-group">
<label>Reg Date: *</label> <input type="text" name="regDate" value="<?php echo $regDate; ?>"/><br/>
</div>

<div  class="input-group">
<label>User Name: *</label> <input type="text" name="username" value="<?php echo $username; ?>"/><br/>
</div>

<div  class="input-group">
<label>Email: *</label> <input type="text" name="email" value="<?php echo $email; ?>"/><br/>
</div>

<div  class="input-group">
<label>Role: *</label> <input type="text" name="role" value="<?php echo $role; ?>"/><br/>
</div>

<div style="width: 25%, color:Red" class="input-group">
<p style="color:Red">* Required</p>
</div>

<div style="text-align: center" class="input-group">
<button style="background: Red" type="button" class="btn" name="cancel" value="cancel" onClick="window.location='listUsers.php';" />Cancel</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" name="submit" class="btn" value="Submit">Submit</button>
</div>


</div>

</form>

</body>


<?php

}







// connect to the database

include('connect-db.php');



// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];
$regDate = mysql_real_escape_string(htmlspecialchars($_POST['regDate']));
$username = mysql_real_escape_string(htmlspecialchars($_POST['username']));
$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
$role= mysql_real_escape_string(htmlspecialchars($_POST['role']));


// check that all fields are filled in

if ($regDate == '' || $username == '' || $email == '' || $role == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($id, $regDate, $username, $email, $role, $error);

}

else

{

// save the data to the database

mysql_query("UPDATE users SET regDate='$regDate', username='$username', email='$email', role='$role' WHERE id=$id")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: listUsers.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checking that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];

$result = mysql_query("SELECT id, regDate, username, email, role FROM users WHERE id=$id")

or die(mysql_error());

$row = mysql_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$id = $row['id'];

$regDate = $row['regDate'];

$username = $row['username'];

$email = $row['email'];

$role = $row['role'];

// show form

renderForm($id, $regDate, $username, $email, $role, '');


}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>



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

</html>