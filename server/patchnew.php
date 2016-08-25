<?php
/**
 * Created by PhpStorm.
 * User: Haus-IT
 * Date: 8/25/2016
 * Time: 3:34 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikp";
//define variables
$patchFloor = $patchRoom = $patchSwitch = $patchPortnum = $patchVlanid = $patchVlanname = $patchField = $patchDestroom = $patchDestjack = $patchComm = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO patching (floorNum, switchRoom, switchName, switchPortnum, vlanId, vlanName, patchFieldsrc, destinationRoom, destinationJack, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issiisssss", $patchFloor, $patchRoom, $patchSwitch, $patchPortnum, $patchVlanid, $patchVlanname, $patchField, $patchDestroom, $patchDestjack, $patchComm );

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// set parameters and execute
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $patchFloor = isset($_POST['patchFloor']) ? input($_POST['patchFloor']) : "0";
    $patchRoom = isset($_POST['patchRoom']) ? input($_POST['patchRoom']) : "0";
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
    echo "A new entry has been created successfully!! ".'\n' ;
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