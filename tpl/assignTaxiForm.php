
		<div class="popBoxHeader">
        	<div class="popBoxLeft" id="popUpHeaderLeft"><h3 id="popUpHeaderText">Assign a taxi</h3></div>
        	<div class="popBoxRight"><span style="cursor:pointer;" onClick="closePopUpBox()"><img src="images/closeIcon.png" /></span></div>
        </div>
        <form onSubmit="return submitAssignATaxi()" id="assignForm">
        <div class="popBoxBody">
        	<div class="popBoxLeft" id="popUpBoxBodyDiv">
            	<p>Booking Reference Number: <br /><input type="text" id="referenceNumber" name="referenceNumber" onblur="checkValue(this.value)" onkeyup="checkValue(this.value)" /></p>
                <span id="warningMsg" class="warning"></span>
            </div>
        </div>
        <div class="popBoxBtm">
        	<div class="popBoxBtmRight" id="popUpBoxBtmDiv">
            	<input name="submit" type="submit" value="Assign Now" class="inputSubmit"/>
            </div>
            
        </div>
        </form>