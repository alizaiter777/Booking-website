<?php
session_start();
require("Config.php");

// Assuming the logged-in user's ID is stored in a session variable called 'userId'
$userId = $_SESSION['UserId'];

// Fetch reservations for the logged-in user only
$query = "SELECT r.ReservationNb, r.TourId, r.UserId, r.OrderDate, t.Name AS TrailName
          FROM reservation r
          JOIN trail t ON r.TourId = t.Id
          WHERE r.UserId = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Reservation Number</th><th>Trail Name</th><th>Order Date</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ReservationNb']) . "</td>";
        echo "<td>" . htmlspecialchars($row['TrailName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['OrderDate']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No reservations found.";
}

mysqli_close($con);
?>
