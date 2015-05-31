<?php

function getRequestList(){
	$now = time();
	$timeCeiling = $now + 2 * 60 * 60; //within 2 hours
	
	$sql = " SELECT * FROM `bookings` WHERE `booking_status`  = '0' AND `pickup_time` <= '$timeCeiling'";
	
	if(isset($_GET['act']) && $_GET['act']=='all'){
		$sql = " SELECT * FROM `bookings`";
	}
	
	require_once("../inc/db.php");
	$db = new DB();
	$query = $db->query($sql);
	$numRows = $query->num_rows;
	$rows = $query->rows;
	
	$tableHtml = "";
	
	if($numRows < 1){
		$tableHtml = "<tr>
					<td></td>
					<td>No Record Found</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				  </tr>";
	}else{
		foreach($rows as $row){
			$assignmentStatus = $row['booking_status'] == 1 ? "Assigned" : "Unassigned" ;
			$assignmentButton = $row['booking_status'] == 1 ? "" : "<button onclick=\"assignTaxi('".$row['booking_reference']."')\">Assign Taxi</button>" ;
			$tableHtml .="<tr>
							<td>".$row['booking_reference']."</td>
							<td>".$row['customer']."</td>
							<td>".$row['contact_phone']."</td>
							<td>".$row['address_pickup_suburb']."</td>
							<td>".$row['destination_suburb']."</td>
							<td>".$row['pickup_time']."</td>
							<td>$assignmentStatus</td>
							<td id='td".$row['booking_reference']."'>$assignmentButton </td>
						  </tr>";
		}
	}
	
	return $tableHtml;	
}

?>

<table width="100%" border="0" cellspacing="1" cellpadding="0" class="requestListTable">
  <tr class="tableHeader">
    <td>reference number</td>
    <td>customer name</td>
    <td>contact phone</td>
    <td>pick-up suburb</td>
    <td>destination suburb</td>
    <td>pick-up date/time</td>
    <td>Assignment Status</td>
    <td>Operation</td>
  </tr>
  <?php  echo getRequestList(); ?>
</table>