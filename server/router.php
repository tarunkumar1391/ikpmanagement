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
$router = $rfloor = $rroom = $rdescription = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO routers (routerName, floorNum, roomNum, description) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siis", $router, $rfloor, $rroom, $rdescription);

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