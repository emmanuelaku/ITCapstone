<?php

/*

EDIT.PHP

Allows user to edit specific entry in database

*/



// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($entryID, $zone, $xcoord, $ycoord, $lane, $deviceType, $issuesCategory, $issueType, $issueStatus, $dueDate,$comment, $error)

{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>Edit Issue</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $entryID; ?>"/>

<div>

<strong>Entry ID:</strong> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="id" value="<?php echo $entryID; ?>" readonly /><br/>
<br/>
<strong>Zone: *</strong> <input type="text" name="zone" value="<?php echo $zone; ?>"/><br/>
<br/>
<strong>Xcoord: *</strong> <input type="text" name="xcoord" value="<?php echo $xcoord; ?>"/><br/>
<br/>
<strong>Ycoord: *</strong> <input type="text" name="ycoord" value="<?php echo $ycoord; ?>"/><br/>
<br/>
<strong>Lane: *</strong> <input type="text" name="lane" value="<?php echo $lane; ?>"/><br/>
<br/>
<strong>Device Type: *</strong> <input type="text" name="deviceType" value="<?php echo $deviceType; ?>"/><br/>
<br/>
<strong>Issues Category: *</strong> <input type="text" name="issuesCategory" value="<?php echo $issuesCategory; ?>"/><br/>
<br/>
<strong>Issue Type: *</strong> <input type="text" name="issueType" value="<?php echo $issueType; ?>"/><br/>
<br/>
<strong>Issue Status: *</strong> <input type="text" name="issueStatus" value="<?php echo $issueStatus; ?>"/><br/>
<br/>
<strong>Due Date: *</strong> <input type="text" name="dueDate" value="<?php echo $dueDate; ?>"/><br/>
<br/>
<strong>Comment: *</strong>
<textarea name="comment" value="<?php echo $comment; ?>" rows="5" cols="40" maxlength="1000" placeholder="Max characters is 1000"></textarea><br>
<br/>

<p>* Required</p>

<input type="submit" name="submit" value="Submit">
<input type="button" name="cancel" value="cancel" onClick="window.location='assignIssues.php';" />
</div>

</form>

</body>

</html>

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

$entryID = $_POST['id'];
$zone = mysql_real_escape_string(htmlspecialchars($_POST['zone']));
$xcoord = mysql_real_escape_string(htmlspecialchars($_POST['xcoord']));
$ycoord = mysql_real_escape_string(htmlspecialchars($_POST['ycoord']));
$lane = mysql_real_escape_string(htmlspecialchars($_POST['lane']));
$deviceType = mysql_real_escape_string(htmlspecialchars($_POST['deviceType']));
$issuesCategory= mysql_real_escape_string(htmlspecialchars($_POST['issuesCategory']));
$issueType= mysql_real_escape_string(htmlspecialchars($_POST['issueType']));
$issueStatus = mysql_real_escape_string(htmlspecialchars($_POST['issueStatus']));
$dueDate = mysql_real_escape_string(htmlspecialchars($_POST['dueDate']));
$comment = mysql_real_escape_string(htmlspecialchars($_POST['comment']));

// check that all fields are filled in

if ($zone == '' || $xcoord == '' || $ycoord == '' || $lane == '' || $deviceType == '' || $issuesCategory == '' || $issueType == '' || $issueStatus == '' || $dueDate == '' || $comment == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($entryID, $zone, $xcoord, $ycoord, $lane, $deviceType, $issuesCategory, $issueType, $issueStatus, $dueDate,$comment, $error);

}

else

{

// save the data to the database

mysql_query("UPDATE reported_issues SET zone='$zone', xcoord='$xcoord', ycoord='$ycoord', lane='$lane', deviceType='$deviceType', issuesCategory='$issuesCategory', issueType='$issueType', issueStatus='$issueStatus', dueDate='$dueDate', comment='$comment' WHERE entryID=$entryID")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: assignIssues.php");

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

$entryID = $_GET['id'];

$result = mysql_query("SELECT entryID, xcoord, ycoord, dueDate, zone, lane, deviceType, issuesCategory, issueType, issueStatus, comment FROM reported_issues WHERE entryID=$entryID")

or die(mysql_error());

$row = mysql_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$entryID = $row['entryID'];

$zone = $row['zone'];

$xcoord = $row['xcoord'];

$ycoord = $row['ycoord'];

$lane = $row['lane'];

$deviceType = $row['deviceType'];

$issuesCategory = $row['issuesCategory'];

$issueType = $row['issueType'];

$issueStatus = $row['issueStatus'];

$dueDate = $row['dueDate'];

$comment = $row['comment'];

// show form

renderForm($entryID, $zone, $xcoord, $ycoord, $lane, $deviceType, $issuesCategory, $issueType, $issueStatus, $dueDate, $comment, '');


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