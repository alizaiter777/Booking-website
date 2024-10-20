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
        $query = "SELECT U.ID, U.Username, U.Email, U.Image, U.RoleId FROM users U";

        $result = mysqli_query($con, $query);
        echo "<table>";
        echo "<tr> 
                <th>Image</th> 
                <th>Name</th> 
                <th>Email</th>
                <th>RoleId</th>
                <th>Action</th>
              </tr>";
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            $img = $row["Image"];
            echo "<td data-label='Image'><img src='..\\Uploads\\$img' height='50px' width='50px'/></td>";
            echo "<td data-label='Name'>" . $row["Username"] . "</td>";
            echo "<td data-label='Email'>" . $row["Email"] . "</td>";
            echo "<td data-label='RoleId'>" . $row["RoleId"] . "</td>";

            $id = $row["ID"];
            $id = base64_encode($id);
            echo "<td data-label='Action'><a href='DeleteUser.php?x=$id' class='delete-button' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
