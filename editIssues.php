<head>
<link href="ITcapstone.css" rel="stylesheet" type="text/css">
<title>Edit Issue</title>
<?php include "registeredmenu.php";?>

<?php
$conn = mysqli_connect("localhost", "manager", "my*password", "ITcapstone")
	or die("Cannot connect to database:" . mysqli_connect_error($conn));


	
$issueToEdit = $_GET['issueToEdit'];
// echo $issueToEdit . "</br>"; //TESING AND TROUBLESHOOTING: Check previous form input
$sql = "SELECT * FROM reported_issues WHERE entryID = $issueToEdit;";
// echo $sql . "</br>"; // TESING AND TROUBLESHOOTING: Check SQL query
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//echo $row["zone"] . "</br>" . $row["lane"] . "</br>" . $row["deviceType"] . "</br>" . $row["issueType"] . "</br>" . $row["issueStatus"] . "</br>" . $row["dueDate"]; // TESING AND TROUBLESHOOTING: Check SQL query
$zone = $row["zone"];
$lane = $row["lane"];
$deviceType = $row["deviceType"];
$issueType = $row["issueType"];
$issueStatus = $row["issueStatus"];
$dueDate = $row["dueDate"];
$comment = $row["comment"];
$xcoord = $row["xcoord"];
$ycoord = $row["ycoord"];
$postDate = $row["post_date"];

?>

	<style>
	body {
		background-color: #FFF;
	}
	#contentContainer {
		position: absolute;
		border: 5px black solid;
		overflow: hidden;
		cursor: pointer;
	}
	#dot {
		position: absolute;
		left: <?php echo $xcoord ?>px;
		top: <?php echo $ycoord ?>px;
	}
	</style>
</head>

<body>

<form name="searchForm" method="post" action="editSubmitted.php">

<?php
echo '<input type="hidden" id="entryID" name="entryID" value="' . $issueToEdit . '"';
?>
<br>
<label> Zone: </label>
<select name="zone" id="zone" required onchange="mapChange(this);">
<option value="aught" selected>Any</option>
<?php
$query = "SELECT * from zones;";   
$result = mysqli_query($conn, $query);

if (!$result) {
	die("Invalid query: " . mysqli_error($conn));
	}
	else {
		while($row = mysqli_fetch_array($result)){
			if ($row['zone'] === $zone) { // nested if to assigned 'selected' attribute to matching element
				$selected_attribute = 'selected';}
			else {
				$selected_attribute = '';}
			echo "<option value='{$row['imgName']}'" . $selected_attribute . ">{$row['zone']}</option>" ;
		}
	}
?>     
</select>
<br>


<label> Lane: </label>
<select name= "lane" id="lane" required>
<option value="aught" selected>Any</option>
<?php
$query = "SELECT * from lanes;";   
$result = mysqli_query($conn, $query);

if (!$result) {
	die("Invalid query: " . mysqli_error($conn));
}
else {
	while($row = mysqli_fetch_array($result)){
		if ($row['lane'] === $lane) { // nested if to assigned 'selected' attribute to matching element
			$selected_attribute = 'selected';}
		else {
			$selected_attribute = '';}
		echo "<option value='{$row['lane']}'" . $selected_attribute . ">{$row['lane']}</option>" ;
	}
}
?>     
</select>
<br>


<label> Device: </label>
<select name= "device" id="device" required>
<option value="aught" selected>Any</option>
<?php
$query = "SELECT * from devices;";   
$result = mysqli_query($conn, $query);

if (!$result) {
	die("Invalid query: " . mysqli_error($conn));
}
else {
	while($row = mysqli_fetch_array($result)){
		if ($row['deviceType'] === $deviceType) { // nested if to assigned 'selected' attribute to matching element
			$selected_attribute = 'selected';}
		else {
			$selected_attribute = '';}
		echo "<option value='{$row['deviceType']}'" . $selected_attribute . ">{$row['deviceType']}</option>" ;
	}
}
?>     
</select>
<br>


<label> Issue: </label>
<select name= "issue" id="issue" required>
<option value="aught" selected>Any</option>
<?php
$query = "SELECT * from issues;";   
$result = mysqli_query($conn, $query);

if (!$result) {
	die("Invalid query: " . mysqli_error($conn));
}
else {
	while($row = mysqli_fetch_array($result)){
		if ($row['issueType'] === $issueType) { // nested if to assigned 'selected' attribute to matching element
			$selected_attribute = 'selected';}
		else {
			$selected_attribute = '';}
		echo "<option value='{$row['issueType']}'" . $selected_attribute . ">{$row['issueType']}</option>" ;
	}
}
?>     

</select>
<br>


<label> Status: </label>
<select name= "status" id="status" required>
<option value="aught" selected>Any</option>
<?php
$query = "SELECT * from status;";   
$result = mysqli_query($conn, $query);

if (!$result) {
	die("Invalid query: " . mysqli_error($conn));
}
else {
	while($row = mysqli_fetch_array($result)){
		if ($row['issueStatus'] === $issueStatus) { // nested if to assigned 'selected' attribute to matching element
			$selected_attribute = 'selected';}
		else {
			$selected_attribute = '';}
		echo "<option value='{$row['issueStatus']}'" . $selected_attribute . ">{$row['issueStatus']}</option>" ;
	}
}
?>     
</select>
</br>

<label> Due Date: </label>
<input type="date" name="datepicker" id="datepicker" required autocomplete="off" value=<?php echo $dueDate; ?> ><br>

<?php echo "Post Date : " . $postDate . "</br>"; ?>

<textarea name="comment" id="comment" rows="5" cols="40" maxlength="1000" placeholder="Max characters is 1000"><?php echo $comment; ?></textarea><br>

X coordinate: <input type="text" id="xcoord" name="xcoord" value = <?php echo $xcoord ?> readonly>

Y coordinate: <input type="text" id="ycoord" name="ycoord" value = <?php echo $ycoord ?> readonly>

<input type = submit value="Submit">

</form>

<?php
$query = 'SELECT * from zones WHERE zone = "' . $zone . '";';
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$imgName = $row['imgName'];

?>

<div id="contentContainer">
    <img id="map" src="img/<?php echo $imgName ?>.png"> <!-- map image -->
    <img id="dot" src="img/dot.png" width=1%> <!-- red dot -->
</div>
<?php
//} //End bracket for authentication ELSE statement above DOCTYPE
?>
</body>
	<script src="map.js"></script>