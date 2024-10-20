<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("Config.php");

// Debugging: Print all POST data
echo '<pre>';
print_r($_POST);
echo '</pre>';

if (!isset($_POST['origin'], $_POST['destination'], $_POST['mode'], $_POST['distance'], $_POST['duration'])) {
    echo "Missing data!";
    exit();
}

// Retrieve form data
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$mode = $_POST['mode'];
$distance = $_POST['distance'];
$duration = $_POST['duration'];

// Debugging: Check the values received
echo "Received data: <br>";
echo "Origin: $origin <br>";
echo "Destination: $destination <br>";
echo "Mode: $mode <br>";
echo "Distance: $distance <br>";
echo "Duration: $duration <br>";

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO privatetrail (origin, destination, mode, distance, duration) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    echo "Prepare failed: " . $conn->error;
    exit();
}

$stmt->bind_param("sssss", $origin, $destination, $mode, $distance, $duration);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
