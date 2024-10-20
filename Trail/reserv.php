<?php
session_start();
require("Config.php");

if (isset($_GET['trailId']) && is_numeric($_GET['trailId']) && isset($_GET['userId']) && is_numeric($_GET['userId'])) {
    $trailId = intval($_GET['trailId']);
    $userId = intval($_GET['userId']);
    $orderDate = date('Y-m-d');

    // Check if the user has already booked this trail
    $checkQuery = $con->prepare("SELECT * FROM reservation WHERE TourId = ? AND UserId = ?");
    $checkQuery->bind_param("ii", $trailId, $userId);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        echo "You have already booked this trail.";
    } else {
        // Prepare and execute the query
        $stmt = $con->prepare("INSERT INTO reservation (TourId, UserId, OrderDate) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $trailId, $userId, $orderDate);

        if ($stmt->execute()) {
            echo "Reservation successful.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkQuery->close();
    $con->close();
} else {
    echo "Invalid parameters.";
}
?>
