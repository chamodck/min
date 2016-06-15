<?php
include "dbconfig.php";
$sql="SELECT user.fname , user.lname , boat.name , DATE_FORMAT(trip.starttime,'%Y-%m-%d') AS startdate , DATE_FORMAT(trip.endtime,'%Y-%m-%d') AS enddate , trip.* FROM user,trip,boat WHERE trip.observer_id=user.id AND trip.boat_reg_no=boat.reg_no";
$result=$conn->query($sql);
$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>