<?php
//store all data into database
if(isset($_POST)){
	$customer = $_POST['name'];
	$contact_phone = $_POST['phone'];
	$address_pickup = "Unit:" .$_POST['unitNumber'].", " .$_POST['streetNumber'] . " " .$_POST['street'];
	$address_pickup_suburb =  $_POST['suburbFrom'];
	$destination_suburb = $_POST['destinationSuburb'];
	$pickup_time =(int)($_POST['pickupTime'])/1000; // in seconds
	$booking_time = time();
	$booking_reference = substr(time(), 3); //use booking time as reference
	$booking_status = 0;
	
	$sql = "INSERT INTO `bookings` (`customer`, `contact_phone`, `address_pickup`, `address_pickup_suburb`, `destination_suburb`, `pickup_time`, `booking_time`, `booking_reference`, `booking_status` ) VALUES('$customer', '$contact_phone', '$address_pickup', '$address_pickup_suburb', '$destination_suburb', '$pickup_time', '$booking_time', '$booking_reference', '$booking_status')";
	
	require_once("./inc/db.php");
	$db = new DB();
	if($query = $db->query($sql)){
		echo "<p>You have requested for a taxi, and your reference number is: <br/><span style='color: red; font-weight:bold;'>" . $booking_reference . "</span> </p>";
		echo "<p> The status of your request is : <br/><span style='color: red; font-weight:bold;'>Unassigned</span> </p>";
	}else{
		echo "<p>Your requested for taxi is failed! please try again!</p>";
	}
}

?>