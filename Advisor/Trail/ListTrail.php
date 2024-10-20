<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="navbar.css"> 
<link rel="stylesheet" href="../table.css"> 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Trails</h1>
    <a href="../index.php">home</a>
    <a href="AddTrail.php">Add new Trail</a>
    <?php 
    require_once("Config.php");
    $query = "SELECT T.ID, T.Name, T.Price, T.CatId, T.Image,T.PageUrl,T.Location,T.Sport,T.Difficulty
     FROM trail T
     ";

    $result = mysqli_query($con, $query);
    echo "<table border='1' >";
    echo "<tr>  <th>Image</th> 
                <th> Name </th> 
                <th> Price </th>
                <th> CatId </th>
                <th> PageUrl </th>
                <th> Location </th>
                <th> Sport </th>
                <th> Difficulty </th>


                <th>  </th>
                 
				 </tr>";
    while( $row = mysqli_fetch_array($result) ) {
            echo "<tr>";
            $img = $row["Image"];
            echo "<td><img src='..\\Uploads\\$img' height='50px' width='50px'/> </td>";
            echo "<td data-label='Name'>".$row["Name"]."</td>";
            echo "<td data-label='Price'>".$row["Price"]."</td>";
            echo "<td data-label='CatId'>".$row["CatId"]."</td>";
            echo "<td data-label='PageUrl'>".$row["PageUrl"]."</td>";
            echo "<td data-label='Location'>".$row["Location"]."</td>";
            echo "<td data-label='Sport'>".$row["Sport"]."</td>";
            echo "<td data-label='Difficulty'>".$row["Difficulty"]."</td>";
            echo "<td data-label='Edit'><a href='EditTrail.php?Id=".$row["ID"]."'>Edit</td>";
            $id = $row["ID"];
            $id = base64_encode($id);
            echo "<td><a href='DeleteTrail.php?x=$id' class='delete-button' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";

            echo "</tr>";
    }
    echo "</table>";
    ?>

</body>
</html>