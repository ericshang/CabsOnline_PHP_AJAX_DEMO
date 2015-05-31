// JavaScript Document

var xmlhttp = getXmlHttp();
var isValid = true;

function openPopUpBox(){
	var url = "./tpl/assignTaxiForm.php";
	var popBox = document.getElementById("popBox");
	if(xmlhttp!=null){
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

function getAssignTaxiFormPopUp(referenceNum){
	var url = "./tpl/assignTaxiForm.php";
	var popBox = document.getElementById("popBox");
	if(xmlhttp!=null){
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText.length >0){
					popBox.innerHTML= xmlhttp.responseText;
					 referenceNumberInput = document.getElementById('referenceNumber');
					if(!isNaN(referenceNum)){
						referenceNumberInput.value = referenceNum;
					}
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

function submitAssignATaxi(){//to handle submition of the form
	var popUpHeaderText = document.getElementById("popUpHeaderText");
	var popUpBoxBodyDiv = document.getElementById("popUpBoxBodyDiv");
	var popUpBoxBtmDiv = document.getElementById("popUpBoxBtmDiv");
	
	//check if all fields are legal
	var value = document.getElementById("referenceNumber").value;
	checkValue(value);
	
	data = "referenceNumber=" +value;
	
	if(isValid == false){
		return false;
	}
	var url = "./assignTaxi.php";
	var popBox = document.getElementById("popBox");
	if(xmlhttp!=null){
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText.length >0){
					popUpBoxBodyDiv.innerHTML = xmlhttp.responseText;
					popUpBoxBtmDiv.innerHTML = "";
					popBox.style.height="auto";
					setPopUpBoxPosition();
				}
			}else{
				popUpBoxBodyDiv.innerHTML = "Submitting";
				popUpBoxBtmDiv.innerHTML = "";
				popBox.style.height="auto";
				setPopUpBoxPosition();
			}
		}
		
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

//to show request list
function showBookingList(isToClosePopUp){
	//close the pop up window in case needed
	if(isToClosePopUp == true)
		closePopUpBox();
	
	var url = "./tpl/bookingListForm.php";
	var requestListDiv = document.getElementById("requestListDiv");
	if(xmlhttp!=null){
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText.length >0){
					requestListDiv.innerHTML= xmlhttp.responseText;
				}
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
}

//to show request list
function showAllBookingList(isToClosePopUp){
	//close the pop up window in case needed
	if(isToClosePopUp == true)
		closePopUpBox();
	
	var url = "./tpl/bookingListForm.php?act=all";
	var requestListDiv = document.getElementById("requestListDiv");
	if(xmlhttp!=null){
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText.length >0){
					requestListDiv.innerHTML= xmlhttp.responseText;
				}
			}
		}
		xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
}

//to assign taxi
function assignTaxi(referenceNum){
	getAssignTaxiFormPopUp(referenceNum);
}


//show warning
function showWarningMsg(msg){
	if (msg == null) return ;
	var warningMsgContainer = document.getElementById("warningMsg");
	warningMsgContainer.innerHTML = msg;
}

function checkValue(value){
	var warningMsgContainer = document.getElementById("warningMsg");
	warningMsgContainer.innerHTML ="";
	
	isValid = true;
	
	if(value.length > 0 ){
		if(isNaN(value)){
			showWarningMsg("value must be a number");
			isValid = false;
		}
	}else{
		showWarningMsg("value is empty!");
		isValid = false;
	}	
}