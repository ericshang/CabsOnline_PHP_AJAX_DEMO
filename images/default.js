// JavaScript Document

var xmlhttp = getXmlHttp();

var isSubmitValid = true;

function openPopUpBox(){
	var url = "./tpl/bookingform.php";
	var popBox = document.getElementById("popBox");
	if(xmlhttp!=null){//get the form page from server
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText.length >0){
					popBox.innerHTML= xmlhttp.responseText;
					popBox.style.height="auto";
					setPopUpBoxPosition();
					popBox.style.visibility = "visible";
				}
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
}

function closePopUpBox(){
	var popBox = document.getElementById("popBox");
	popBox.style.visibility = "hidden";
	popBox.style.height= "0";
}

function setPopUpBoxPosition(){
	var popBox = document.getElementById("popBox");
	
	popBox.style.height="auto";//!important
	
	var popBoxOffsetHeight = popBox.offsetHeight;
	var visibleAreaHeight = window.innerHeight;
	var popBoxTop = (popBoxOffsetHeight >= visibleAreaHeight) ? 0 : parseInt((visibleAreaHeight-popBoxOffsetHeight)/2);
	
	var popBoxOffsetWidth = popBox.offsetWidth;
	var visibleAreaWidth = document.body.clientWidth;
	var popBoxLeft = (popBoxOffsetWidth >= visibleAreaWidth) ? 0 : parseInt((visibleAreaWidth-popBoxOffsetWidth)/2);
	popBox.style.top = popBoxTop+"px";
	popBox.style.left = popBoxLeft+"px";
}

function submitBooking(){
	var popUpHeaderText = document.getElementById("popUpHeaderText");
	var popUpBoxBodyDiv = document.getElementById("popUpBoxBodyDiv");
	var popUpBoxBtmDiv = document.getElementById("popUpBoxBtmDiv");
	
	//check if all fields are legal
	checkAllFields();
	
	if(isSubmitValid == false){
		return false;
	}
	var url = "./addBookings.php";
	var popBox = document.getElementById("popBox");
	if(xmlhttp!=null){
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText.length >0){
					popUpHeaderText.innerHTML="Request Submitted";
					popUpBoxBodyDiv.innerHTML = xmlhttp.responseText;
					popUpBoxBtmDiv.innerHTML = "";
					popBox.style.height="auto";
					setPopUpBoxPosition();
				}
			}else{
				popUpHeaderText.innerHTML="Request Submiting";
				popUpBoxBodyDiv.innerHTML = xmlhttp.responseText;
				popUpBoxBtmDiv.innerHTML = "";
				popBox.style.height="auto";
				setPopUpBoxPosition();
			}
		}
		
		//get data from the input area
		var data = getDataFromForm();
		
		xmlhttp.open("POST",url,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(data);
	}
	return false; //stop submitting form
}
function getXmlHttp(){
	var xmlhttp;
	if(window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
}

///checks and warnings
function checkValue(value, ContainerId, type){
	var container = document.getElementById(ContainerId);
	container.innerHTML = "";
	isTrue = true;
	
	if(value.length > 0){
		container.innerHTML = "";		
		if(type == "number" && isNaN(value)){
			container.innerHTML = "It must be numbers!";
			isTrue = false;
		}
		
	}else{
		container.innerHTML = "Must not be Empty!";
		isTrue = false;
	}
	
	return isTrue;
}
function checkField(id, type){
	var field = document.getElementById(id);
	var value = field.value;
	var containerId = id+"Warning";
	return checkValue(value, containerId, type);
}
//check if all fields are legal
function checkAllFields(){
	var isNameValid = checkField("name", "string"); 
	var isPhoneValid = checkField("phone", "number");
	var isStreetNumbereValid = checkField("streetNumber", "string");
	var isStreetValid = checkField("street", "string");
	var isSuburbFromValid = checkField("suburbFrom","string");
	var isDestinationValid = checkField("destinationSuburb","string");
	var isTimeValid = checkTime();
		
	isSubmitValid = isNameValid && isPhoneValid && isStreetNumbereValid && isStreetValid && isSuburbFromValid && isDestinationValid && isTimeValid;
}

//check if time legal
function checkTime(){
	var currentTime = new Date().getTime(); // in mil second
	document.getElementById("dateWarning").innerHTML = "";
	
	if(getInputTime() <= currentTime){
		isSubmitValid = false;
		document.getElementById("dateWarning").innerHTML = "Pick-up time must be in future!";
		return false;
	}
	return true;
}
//return user input time in Date object
function getInputTime(){
	var hour = document.getElementById("hour").value;
	var minute = document.getElementById("minute").value;
	var year = document.getElementById("year").value;
	var month = document.getElementById("month").value;
	var day = document.getElementById("day").value;
	
	var inputTime = new Date();
	inputTime.setFullYear(year, (month-1), day);
	inputTime.setHours(hour, minute,0);
	return inputTime;
}


function getDataFromForm(){
	var bookingForm = document.getElementById("bookingForm");
	
	var elements = new Array();    
    var tagElements = bookingForm.getElementsByTagName('input');    
    for (var j = 0; j < tagElements.length; j++){  
         elements.push(tagElements[j]);   
    }
	
	var dataString = "";//convert to a name=value string
	for(var i =0; i < elements.length; i++ ){
		var name = elements[i].name;
		var value = elements[i].value;
		if(i==0){
			dataString = name + "=" + value;
		}else{
			dataString += "&"+ name + "=" + value;
		}
	}
	return dataString + "&pickupTime="+getInputTime().getTime();	
}