<?php
/**
 * Created by PhpStorm.
 * User: tkumar
 * Date: 8/31/16
 * Time: 4:48 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikp";
//define variables
$sno = $swFloor = $swRoom = $patchSwitch = $patchPortnum = $patchVlanid = $patchVlanname= $patchField = $patchDestroom = $patchDestjack = $patchComm = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("UPDATE patching SET floorNum=?, switchRoom=?,  switchName=?, switchPortnum=?, vlanId=?, vlanName=?, patchFieldsrc=?, destinationRoom=?, destinationJack=?, comments=? WHERE sno=?");
$stmt->bind_param("issiisssssi", $swFloor, $swRoom, $patchSwitch, $patchPortnum, $patchVlanid, $patchVlanname, $patchField, $patchDestroom, $patchDestjack, $patchComm, $sno);

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// set parameters and execute
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $sno = isset($_POST['sno']) ? input($_POST['sno']) : "0";
    $swFloor = isset($_POST['swFloor']) ? input($_POST['swFloor']) : "0";
    $swRoom = isset($_POST['swRoom']) ? input($_POST['swRoom']) : "0";
    $patchSwitch = isset($_POST['patchSwitch']) ? input($_POST['patchSwitch']) : "0";
    $patchPortnum = isset($_POST['patchPortnum']) ? input($_POST['patchPortnum']) : "0";
    $patchVlanid = isset($_POST['patchVlanid']) ? input($_POST['patchVlanid']) : "0";
    $patchVlanname = isset($_POST['patchVlanname']) ? input($_POST['patchVlanname']) : "0";
    $patchField = isset($_POST['patchField']) ? input($_POST['patchField']) : "0";
    $patchDestroom = isset($_POST['patchDestroom']) ? input($_POST['patchDestroom']) : "0";
    $patchDestjack = isset($_POST['patchDestjack']) ? input($_POST['patchDestjack']) : "0";
    $patchComm = isset($_POST['patchComm']) ? input($_POST['patchComm']) : "0";



}


if ($stmt->execute()) {
    echo "The entry". $sno ." has been updated successfully!! ".'\n' ;
    echo '<a href="../www/index.html">click here to return!!</a>';
//    header("Location: ../www/index.html");

} else {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

//if( true === $stmt){
//    die('execute() failed: ' . htmlspecialchars($stmt->error));
//}
//

//printf ("New records created successfully", $stmt->error);


$stmt->close();
$conn->close();
?>