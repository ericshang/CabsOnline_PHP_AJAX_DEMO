<?php

function getDateSelect(){
	$html = "";
	
	$dayOption ="";
	$monthOption = "";
	$YearOption = "";
	
	for($i=1; $i<=31; $i++){
		$value = $i<10 ? "0".$i : $i;
		$dayOption .= "<option value = '$i'>$value</option>";
	}
	for($i=1; $i<=12; $i++){
		$value = $i<10 ? "0".$i : $i;
		$value = date($i);
		$monthOption .= "<option value = '$i'>$value</option>";
	}
	$currentYear = date("Y");
	for($i=$currentYear; $i<$currentYear +3; $i++){
		$value = $i<10 ? "0".$i : $i;
		$YearOption .= "<option value = '$i'>$value</option>";
	}
	
	$html = "<select name='day' id='day'>$dayOption</select>
             <select name='month' id='month'>$monthOption</select>
             <select name='year' id='year'>$YearOption</select>";
	echo $html;
}


function getTimeSelect(){	
	$minuteOption ="";
	$hourOption = "";
	
	for($i=1; $i<60; $i++){
		$value = $i<10 ? "0".$i : $i;
		$minuteOption .= "<option value = '$i'>$value</option>";
	}
	for($i=1; $i<24; $i++){
		$value = $i<10 ? "0".$i : $i;
		$hourOption .= "<option value = '$i'>$value</option>";
	}
	
	echo "<select name='hour' id='hour'>$hourOption</select> : <select name='minute' id=minute>$minuteOption</select>";
}

?>



		<div class="popBoxHeader">
        	<div class="popBoxLeft" id="popUpHeaderLeft"><h3 id="popUpHeaderText">Booking a taxi</h3></div>
        	<div class="popBoxRight"><span style="cursor:pointer;" onClick="closePopUpBox()"><img src="images/closeIcon.png" /></span></div>
        </div>
        <form onSubmit="return submitBooking()" action="addBookings.php" id="bookingForm">
        <div class="popBoxBody">
        	<div class="popBoxLeft" id="popUpBoxBodyDiv">
            
                <p>* Name: <br /> <input name="name" id="name" onkeyup="checkValue(this.value, 'nameWarning')" onblur="checkValue(this.value, 'nameWarning')"/><span id="nameWarning" class="warning"></span></p>
                <p>* contact phone: <br /> <input name="phone" id="phone" onkeyup="checkValue(this.value, 'phoneWarning', 'number')" onblur="checkValue(this.value, 'phoneWarning', 'number')" /><span id="phoneWarning" class="warning"></span></p>
                <p>
                	* Pick Up Time:<span style="font-size:10px; color:#666666;">(HH : MM)</span> <br />
                 	<?php getTimeSelect(); ?>
                 </p>
                <p> 
                    * Pick Up Date: <span style="font-size:10px; color:#666666;">(DD-MM-YYYY)</span> <br /> 
					<?php getDateSelect(); ?><span id="dateWarning" class="warning"></span>
                </p>
                
                <h3>Pick up From: </h3>
                <p>
                	Unit: <br /><input name="unitNumber" id="unit" class="inputAddressNumbers"/><span id="unitWarning" class="warning"></span>
                </p>
                <p>
                	* Street Number: <br /><input name="streetNumber" id="streetNumber" class="inputAddressNumbers" onkeyup="checkValue(this.value, 'streetNumberWarning')" onblur="checkValue(this.value, 'streetNumberWarning')" /><span id="streetNumberWarning" class="warning"></span><br />
                    * Street:<br /><input name="street" id="street"  onkeyup="checkValue(this.value, 'streetWarning')" onblur="checkValue(this.value, 'streetWarning')" /><span id="streetWarning" class="warning"></span><br />
                    * Suburb:<br /><input name="suburbFrom" id="suburbFrom" onkeyup="checkValue(this.value, 'suburbFromWarning')" onblur="checkValue(this.value, 'suburbFromWarning')" /><span id="suburbFromWarning" class="warning"></span>
                </p>
                <h3>Destination to: </h3>
                <p> 
                    * Suburb: <br /> <input name="destinationSuburb" id="destinationSuburb"  onkeyup="checkValue(this.value, 'destinationSuburbWarning')" onblur="checkValue(this.value, 'destinationSuburbWarning')" /><span id="destinationSuburbWarning" class="warning"></span>
                </p>
			
            
            </div>
        </div>
        <div class="popBoxBtm">
        	<div class="popBoxBtmRight" id="popUpBoxBtmDiv">
            	<input name="submit" type="submit" value="Submit" class="inputSubmit"/>
            </div>
            
        </div>
        </form>