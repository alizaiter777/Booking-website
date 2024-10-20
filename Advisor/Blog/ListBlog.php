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
    <h1>Blogs</h1>
    
    <a href="Blog.php">Add new Blog</a>
    <?php 
    require_once("Config.php");
    $query = "SELECT B.id, B.title, B.content ,B.image
     FROM blog B 
     ";

    $result = mysqli_query($con, $query);
    echo "<table border='1' >";
    echo "<tr>  <th>Image</th> 
                <th> Title </th> 
                <th> content </th>
                <th>  </th>
                 
				 </tr>";
    while( $row = mysqli_fetch_array($result) ) {
            echo "<tr>";
            $img = $row["image"];
            echo "<td data-label='image'><img src='..\\Uploads\\$img' height='50px' width='50px'/> </td>";
            echo "<td data-label='title'>".$row["title"]."</td>";
            echo "<td data-label='content'>".$row["content"]."</td>";
            $id = $row["id"];
            $id = base64_encode($id);
            echo "<td><a href='DeleteBlog.php?x=$id' class='delete-button' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";

            echo "</tr>";
    }
    echo "</table>";
    ?>

</body>
</html>