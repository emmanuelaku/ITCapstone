
<!DOCTYPE html>
<title>New Issue</title>

<!-- Header -->
<?php include 'headerFooter.php';
echo "$header";?>
<!-- Header ends -->


 
 <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
 
 <!--My header -->
 
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
	<li><a class="active" href="zone.php">Submit Issue</a></li>
	<li><a href="manageIssues.php">Manage Issues</a></li>
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
 
 <!--My header ends-->

 
 
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
<body>	

<br>
<br>


<?php
   $conn = new mysqli("localhost", "manager",

          "my*password", "ITcapstone");

      if (mysqli_connect_errno($conn)){

          echo 'Cannot connect to database: ' . mysqli_connect_error();

      }
?>

<?php // get zone name from imgName
$imgName = $_POST['zone'];
$sql = "SELECT zone FROM zones WHERE imgName = '" . $imgName . "';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
?>



<body>
  <div style="width: 35%" class="header">
  	<h4>New Issue</h4>
  </div>
  
<form style="width: 35%" method="post" name="form2" action="submitIssue_action.php"> 

<div  class="input-group">
  <label for zone >Zone input</label>
  <input type="not hidden" name="zone" id="zone" readonly value="<?php echo $row['zone']; ?>"></br>
</div>

<div style="width: 25%" class="input-group">
  <label for xcoord> X coordinate:</label><input type="not hidden" name="xcoord" id="xcoord"  readonly value="<?php echo $_POST['xcoord']; ?>"> 

  <label for ycoord> Y coordinate: </label>
  <input type="not hidden" name="ycoord" id="ycoord" readonly value="<?php echo $_POST['ycoord']; ?>"></br>
</div>

<div  class="input-group">
<label for lane> Lane: </label>
<select name= "lane" id="lane" required>
<option value="" selected>----</option>
    <?php
         $query = "SELECT lane from lanes;";   
         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {  
    while($row = mysqli_fetch_array($result)){
     
    echo "<option value='{$row['lane']}'>{$row['lane']}</option>" ; 
    
    }

         }
?>     

  </select>
</div>

<div  class="input-group">
<label> Device: </label>
<select name= "device" id="device" required>
<option value="" selected>----</option>
    <?php
         $query = "SELECT deviceType from devices;";   
         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {  
    while($row = mysqli_fetch_array($result)){
     
    echo "<option value='{$row['deviceType']}'>{$row['deviceType']}</option>" ; 
    
    }

         }
?>     

  </select>
</div>

<div  class="input-group">
<label> Issue: </label>
<select name= "issue" id="issue" required>
<option value="" selected>----</option>
    <?php
         $query = "SELECT issueType from issues;";   
         $result = mysqli_query($conn, $query);

         // Check the result

         if (!$result) {

            die("Invalid query: " . mysqli_error($conn));

         }

         else {  
    while($row = mysqli_fetch_array($result)){
     
    echo "<option value='{$row['issueType']}'>{$row['issueType']}</option>" ; 
    
    }

         }
?>     

  </select>
</div>

<div  class="input-group">
<label>Issues Category: </label>
    <select name= "issuesCategory" id="issuesCategory" required>
       <option value="" selected> ---- </option>
	   <option>Technical</option>
       <option>Maintenance</option>
    </select>
</div>

<div style="width: 30%" class="input-group">
<label> Due Date: </label> 
<input type="date" name="datepicker" id="datepicker" required><br>
</div>

<div  class="input-group">
<label> Comment on Issue: </label>
<textarea name="comment" id="comment" rows="5" cols="40" maxlength="1000" placeholder="Max characters is 1000"></textarea><br>
</div>

<div style="text-align: center" class="input-group">
<button style="background: Red" type="button" class="btn" name="cancel" value="cancel" onClick="window.location='zone.php';" />Cancel</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn" value="Submit">Submit</button>
</div>
</form>

</body>
<br>
<br>
<script>
// alert("You selected some text!");
</script
<!-- Footer using php -->

<?php include 'headerFooter.php';
echo "$footer";?>
	
<!-- End footer -->

</html>