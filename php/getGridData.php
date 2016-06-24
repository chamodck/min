
<?php
include "dbconfig.php";
$_POST = json_decode(file_get_contents("php://input"), true);
$from=$_POST['from'];
$to=$_POST['to'];

if($from=="" && $to==""){
	$sql="SELECT FLOOR(lat) AS latt,FLOOR(lon) AS lonn ,COUNT(*)as count FROM path WHERE image>0 GROUP BY latt , lonn";
}else if($from!="" && $to==""){
	$sql="SELECT FLOOR(lat) AS latt,FLOOR(lon) AS lonn ,COUNT(*)as count FROM path WHERE image>0 AND DATE_FORMAT(datetime,'%Y-%m-%d')>=STR_TO_DATE('$from','%Y-%m-%d') GROUP BY latt , lonn";
}else if($from=="" && $to!=""){
	$sql="SELECT FLOOR(lat) AS latt,FLOOR(lon) AS lonn ,COUNT(*)as count FROM path WHERE image>0 AND DATE_FORMAT(datetime,'%Y-%m-%d')<=STR_TO_DATE('$to','%Y-%m-%d') GROUP BY latt , lonn";
}else{
	$sql="SELECT FLOOR(lat) AS latt,FLOOR(lon) AS lonn ,COUNT(*)as count FROM path WHERE image>0 AND DATE_FORMAT(datetime,'%Y-%m-%d') BETWEEN STR_TO_DATE('$from','%Y-%m-%d') AND STR_TO_DATE('$to','%Y-%m-%d') GROUP BY latt , lonn";
}

$result=$conn->query($sql);
$rows=array();
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[]=$row;
}
echo json_encode(array("table"=>$rows));
?>