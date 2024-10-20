<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="view.css">

    
</head>
<body>
    <h1>Trails</h1>
    <a href="index.php">Home</a>
    <?php
        require_once("Config.php");

        $query = "SELECT R.ReservationNb, R.TourId, R.UserId, R.OrderDate, U.Username, T.Name
                  FROM reservation R
                  LEFT JOIN users U ON R.UserId = U.Id
                  LEFT JOIN trail T ON R.TourId = T.ID";

        $result = mysqli_query($con, $query);

        echo "<table>";
        echo "<tr>
                <th>ReservationNb</th>
                <th>TourId</th>
                <th>UserId</th>
                <th>Username</th>
                <th>TrailName</th>
                <th>OrderDate</th>
                <th>Action</th>
              </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td data-label='ReservationNb'>" . $row["ReservationNb"] . "</td>";
            echo "<td data-label='TourId'>" . $row["TourId"] . "</td>";
            echo "<td data-label='UserId'>" . $row["UserId"] . "</td>";
            echo "<td data-label='Username'>" . $row["Username"] . "</td>";
            echo "<td data-label='TrailName'>" . $row["Name"] . "</td>";
            echo "<td data-label='OrderDate'>" . $row["OrderDate"] . "</td>";
            
            $id = $row["ReservationNb"]; // Assuming ReservationNb is the unique identifier for deletion
            $id = base64_encode($id);
            
            echo "<td data-label='Action'><a href='DeleteUser.php?x=$id' class='delete-button' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
