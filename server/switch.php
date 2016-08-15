<?php
/**
 * Created by PhpStorm.
 * User: tkumar
 * Date: 8/15/16
 * Time: 10:23 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ikp";
//define variables
$switch = $swfloor = $swroom = $swports = $swdescription = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO switches (switchName, noofPorts, floorNum, roomNum, description) VALUES (?, ?, ?, ?,?)");
$stmt->bind_param("siiis", $switch, $swports, $swfloor, $swroom, $swdescription);

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// set parameters and execute
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $switch = isset($_POST['switch']) ? input($_POST['switch']) : "0";
    $swports = isset($_POST['swports']) ? input($_POST['swports']) : "0";
    $swfloor = isset($_POST['swfloor']) ? input($_POST['swfloor']) : "0";
    $swroom = isset($_POST['swroom']) ? input($_POST['swroom']) : "0";
    $swdescription = isset($_POST['swdescription']) ? input($_POST['swdescription']) : "0";
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