<?php
/**
 * Created by PhpStorm.
 * User: Haus-IT
 * Date: 8/25/2016
 * Time: 4:31 PM
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "ikp");

$result = $conn->query("SELECT * FROM patching");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"Sno":"'  . $rs["sno"] . '",';
    $outp .= '"floorNum":"'  . $rs["floorNum"] . '",';
    $outp .= '"switchRoom":"'  . $rs["switchRoom"] . '",';
    $outp .= '"switchName":"'   . $rs["switchName"] . '",';
    $outp .= '"switchPortnum":"'. $rs["switchPortnum"] . '",';
    $outp .= '"vlanId":"'. $rs["vlanId"] . '",';
    $outp .= '"vlanName":"'. $rs["vlanName"] . '",';
    $outp .= '"patchFieldsrc":"'. $rs["patchFieldsrc"] . '",';
    $outp .= '"destinationRoom":"'. $rs["destinationRoom"] . '",';
    $outp .= '"destinationJack":"'. $rs["destinationJack"] . '",';
    $outp .= '"comments":"'. $rs["comments"] . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>
