<?php
/**
 * Created by PhpStorm.
 * User: tkumar
 * Date: 8/29/16
 * Time: 2:50 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "ikp");

$result1 = $conn->query("select sno, floorNum  from switches");


$outp1 = "";

while($rs = $result1->fetch_array(MYSQLI_ASSOC)) {
    if ($outp1 != "") {$outp1 .= ",";}
    $outp1 .= '{"Sno":"'  . $rs["sno"] . '",';
    $outp1 .= '"floorNum":"'. $rs["floorNum"] . '"}';
}
$outp1 ='{"floor":['.$outp1.']}';



$conn->close();

echo($outp1);

?>
