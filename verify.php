<?php
require('Config.php');

$email = mysqli_real_escape_string($con, $_GET['email']);
$token = mysqli_real_escape_string($con, $_GET['token']);

$query = "SELECT * FROM users WHERE Email='$email' AND VerificationToken='$token'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $query = "UPDATE users SET Verified=1 WHERE Email='$email'";
    if (mysqli_query($con, $query)) {
        echo "Your email has been verified. You can now log in.";
        echo '<div style="font-size:20px"><a href="login.php">Login</a></div>';

    } else {
        echo "Error updating verification status: " . mysqli_error($con);
    }
} else {
    echo "Invalid verification link or your email is already verified.";
}