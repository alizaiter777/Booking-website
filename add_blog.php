<?php
session_start();
require("Config.php");

// Check if form data is set
if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['image'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $date = date('Y-m-d'); // Get the current date

    $sql = "INSERT INTO blog (title, content, image, date) VALUES ('$title', '$content', '$image', '$date')";

    if ($con->query($sql) === TRUE) {
        echo "New blog created successfully";
        header("Location: index.php"); // Redirect back to the blog page after submission
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
} else {
    echo "Required form data is missing.";
}

$con->close();
?>
