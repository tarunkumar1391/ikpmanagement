<?php
/**
 * Created by PhpStorm.
 * User: tkumar
 * Date: 8/15/16
 * Time: 10:40 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "ikp");

$result = $conn->query("SELECT * FROM switches");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Sno":"'  . $rs["sno"] . '",';
    $outp .= '"switchName":"'  . $rs["switchName"] . '",';
    $outp .= '"noofPorts":"'  . $rs["noofPorts"] . '",';
    $outp .= '"floorNum":"'   . $rs["floorNum"] . '",';
    $outp .= '"roomNum":"'   . $rs["roomNum"] . '",';
    $outp .= '"description":"'. $rs["description"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>