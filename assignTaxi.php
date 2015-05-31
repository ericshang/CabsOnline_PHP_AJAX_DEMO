<?php
//store all data into database
if(isset($_POST)){
	$referenceNumber = $_POST['referenceNumber'];
	require_once("./inc/db.php");
	//check if the reference number is valid
	$sql = "SELECT * FROM `bookings` WHERE `booking_reference` = '$referenceNumber'";
	$db = new DB();
	$query = $db->query($sql);
	$num_rows = $query->num_rows;
	$row =  $query->row;
	if($num_rows < 1 ){
		echo "<p>Reference Number Does not exist!</p>";
		echo "<p><span style='color: red; font-weight:bold;'> Mission Failed! </span></p>";
		return;
	}
	
	if($row['booking_status'] == 1){
		echo "<p>Reference number: $referenceNumber has already assigned a taxi!</p>";
		echo "<p><span style='color: red; font-weight:bold;'> Mission Failed! </span></p>";
		return;
	}
	
	
	$sql = " UPDATE `bookings` SET `booking_status` = '1' WHERE `booking_reference` = '$referenceNumber'";
	
	if($db->query($sql)){
		echo "<p>Booking Requeste has been assigned:  <span style='color: red; font-weight:bold;'> Successful </span><br />  Reference number is: <span style='color: red; font-weight:bold;'>" . $referenceNumber . "</span> </p>";
	}else{
		echo "<p>Assignment for for taxi is failed! please try again!</p>";
	}
	
}

?>