<?php
/**
 * Created by PhpStorm.
 * User: tkumar
 * Date: 8/29/16
 * Time: 6:16 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "ikp");
$result3 = $conn->query("select sno, floorNum, roomNum, switchName from switches");
$outp = "";
while($rs = $result3->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Sno":"'  . $rs["sno"] . '",';
    $outp .= '"floorNum":"'  . $rs["floorNum"] . '",';
    $outp .= '"floorNum":"'  . $rs["floorNum"] . '",';
    $outp .= '"switchRoom":"'  . $rs["roomNum"] . '",';
    $outp .= '"switchName":"'. $rs["switchName"] . '"}';
}
$outp ='{"switch":['.$outp.']}';


$conn->close();

echo($outp);

?>
