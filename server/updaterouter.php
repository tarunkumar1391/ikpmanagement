<?php
/**
 * Created by PhpStorm.
 * User: Haus-IT
 * Date: 9/1/2016
 * Time: 12:03 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikp";
//define variables
$router = $rfloor = $rroom = $rdescription =$sno= "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("UPDATE  routers SET routerName=?, floorNum=?, roomNum=?, description=? WHERE sno=?");
$stmt->bind_param("sissi", $router, $rfloor, $rroom, $rdescription, $sno);

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// set parameters and execute
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $router = isset($_POST['router']) ? input($_POST['router']) : "0";
    $rfloor = isset($_POST['rfloor']) ? input($_POST['rfloor']) : "0";
    $rroom = isset($_POST['rroom']) ? input($_POST['rroom']) : "0";
    $rdescription = isset($_POST['rdescription']) ? input($_POST['rdescription']) : "0";
    $sno = isset($_POST['sno']) ? input($_POST['sno']) : "0";
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