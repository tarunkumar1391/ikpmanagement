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
$result2 = $conn->query("select sno, floorNum, roomNum from switches");
$outp = "";
while($rs = $result2->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Sno":"'  . $rs["sno"] . '",';
    $outp .= '"floorNum":"'  . $rs["floorNum"] . '",';
    $outp .= '"switchRoom":"'. $rs["roomNum"] . '"}';
}
$outp ='{"room":['.$outp.']}';


$conn->close();

echo($outp);

?>
