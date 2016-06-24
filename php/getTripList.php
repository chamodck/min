<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$from=$_POST['from'];
$to=$_POST['to'];



if($from=="" && $to==""){
	$sql="SELECT user.fname , user.lname , boat.name , DATE_FORMAT(trip.starttime,'%Y-%m-%d') AS startdate , DATE_FORMAT(trip.endtime,'%Y-%m-%d') AS enddate , trip.* FROM user,trip,boat WHERE trip.observer_id=user.id AND trip.boat_reg_no=boat.reg_no";
}else if($from!="" && $to==""){
	$sql="SELECT user.fname , user.lname , boat.name , DATE_FORMAT(trip.starttime,'%Y-%m-%d') AS startdate , DATE_FORMAT(trip.endtime,'%Y-%m-%d') AS enddate , trip.* FROM user,trip,boat WHERE trip.observer_id=user.id AND trip.boat_reg_no=boat.reg_no AND DATE_FORMAT(trip.starttime,'%Y-%m-%d')>=STR_TO_DATE('$from','%Y-%m-%d')";
}else if($from=="" && $to!=""){
	$sql="SELECT user.fname , user.lname , boat.name , DATE_FORMAT(trip.starttime,'%Y-%m-%d') AS startdate , DATE_FORMAT(trip.endtime,'%Y-%m-%d') AS enddate , trip.* FROM user,trip,boat WHERE trip.observer_id=user.id AND trip.boat_reg_no=boat.reg_no AND DATE_FORMAT(trip.endtime,'%Y-%m-%d')<=STR_TO_DATE('$to','%Y-%m-%d')";
}else{
	$sql="SELECT user.fname , user.lname , boat.name , DATE_FORMAT(trip.starttime,'%Y-%m-%d') AS startdate , DATE_FORMAT(trip.endtime,'%Y-%m-%d') AS enddate , trip.* FROM user,trip,boat WHERE trip.observer_id=user.id AND trip.boat_reg_no=boat.reg_no AND DATE_FORMAT(trip.starttime,'%Y-%m-%d')>=STR_TO_DATE('$from','%Y-%m-%d') AND DATE_FORMAT(trip.endtime,'%Y-%m-%d')<=STR_TO_DATE('$to','%Y-%m-%d')";
}
$result=$conn->query($sql);
$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>