<?php

require_once("./inc/db.php");
$db = new DB();

$aucklandArr =  array();
$northshoreArr =  array();
$manukauArr = array();
$papakuraArr = array();
$westAucklandArr = array();
$rodney = array();



$file_dir = "./";
$tableName = "suburb";
$suburb = "";


$myfile = fopen($file_dir."auckland.txt", "r") or die("Unable to open file!");
//process lines
while(!feof($myfile)) {
	$suburb = fgets($myfile);
	$sql = "INSERT INTO  `$tableName` (`suburb` ,`city`) VALUES ('$suburb',  'Auckland') ;"; 
	echo "sql is:" . $sql ."<br />";
	$query= $db->query($sql);
}
fclose($myfile);


$myfile = fopen($file_dir."manukau.txt", "r") or die("Unable to open file!");
//process lines
while(!feof($myfile)) {
	$suburb = fgets($myfile);
	$sql = "INSERT INTO  `$tableName` (`suburb` ,`city`) VALUES ('$suburb',  'Manukau') ;"; 
	echo "sql is:" . $sql ."<br />";
	$query= $db->query($sql);
}
fclose($myfile);






$myfile = fopen($file_dir."northshore.txt", "r") or die("Unable to open file!");
//process lines
while(!feof($myfile)) {
	$suburb = fgets($myfile);
	$sql = "INSERT INTO  `$tableName` (`suburb` ,`city`) VALUES ('$suburb',  'North Shore') ;"; 
	echo "sql is:" . $sql ."<br />";
	$query= $db->query($sql);
}
fclose($myfile);




$myfile = fopen($file_dir."papakura.txt", "r") or die("Unable to open file!");
//process lines
while(!feof($myfile)) {
	$suburb = fgets($myfile);
	$sql = "INSERT INTO  `$tableName` (`suburb` ,`city`) VALUES ('$suburb',  'Papakura') ;"; 
	echo "sql is:" . $sql ."<br />";
	$query= $db->query($sql);
}
fclose($myfile);



$myfile = fopen($file_dir."rodney.txt", "r") or die("Unable to open file!");
//process lines
while(!feof($myfile)) {
	$suburb = fgets($myfile);
	$sql = "INSERT INTO  `$tableName` (`suburb` ,`city`) VALUES ('$suburb',  'Rodney') ;"; 
	echo "sql is:" . $sql ."<br />";
	$query= $db->query($sql);
}
fclose($myfile);



$myfile = fopen($file_dir."westauckland.txt", "r") or die("Unable to open file!");
//process lines
while(!feof($myfile)) {
	$suburb = fgets($myfile);
	$sql = "INSERT INTO  `$tableName` (`suburb` ,`city`) VALUES ('$suburb',  'West Auckland') ;"; 
	echo "sql is:" . $sql ."<br />";
	$query= $db->query($sql);
}
fclose($myfile);





?>