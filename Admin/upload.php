<?php
session_start();
require("Config.php");

if (!isset($_SESSION["LoggedIN_Admin"]) || $_SESSION["LoggedIN_Admin"] != 1) {
    header("Location: ../login.php");
    exit();
}



if (isset($_POST["upload"])) {
    $userId = $_SESSION["UserId_Admin"];
        $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ["jpg", "jpeg", "png", "gif"];

    // Check if the file is an image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION["UPLOAD_ERROR"] = "File is not an image.";
        header("Location: profile.php");
        exit();
    }

    // Check file size (limit to 2MB)
    if ($_FILES["image"]["size"] > 2000000) {
        $_SESSION["UPLOAD_ERROR"] = "Sorry, your file is too large.";
        header("Location: profile.php");
        exit();
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, $allowed_types)) {
        $_SESSION["UPLOAD_ERROR"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        header("Location: profile.php");
        exit();
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Update the user's image path in the database
        $query = "UPDATE users SET Image='$target_file' WHERE Id='$userId'";
        if (mysqli_query($con, $query)) {
            $_SESSION["UPLOAD_SUCCESS"] = "The file ". basename($_FILES["image"]["name"]). " has been uploaded.";
        } else {
            $_SESSION["UPLOAD_ERROR"] = "Error updating database: " . mysqli_error($con);
        }
    } else {
        $_SESSION["UPLOAD_ERROR"] = "Sorry, there was an error uploading your file.";
    }
    header("Location: profile.php");
    exit();
}
?>
