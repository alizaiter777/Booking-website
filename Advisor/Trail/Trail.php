




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Trail</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <h2>Add a New Trail</h2>
    <form action="AddTrail.php" method="POST">

    <label for="Name">NAME:</label><br>
        <input type="text" id="Name" name="Name" required><br>
        <label for="Price">Price:</label><br>
        <input type="number" id="Price" name="Price" required><br>
        <label for="Location">Location:</label><br>
        <input type="text" id="Location" name="Location" required><br>
        <label for="Sport">Sport:</label><br>
        <input type="text" id="Sport" name="Sport" required><br>
        
        Image <input type="file" id="Image" name="Image" />
<br>        
        <input type="Submit" name="btnSave" value="Save" />
        <input type="Reset" value="Clear" />
    </form> 
