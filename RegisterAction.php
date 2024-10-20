<?php
session_start();
require("Config.php");

$name = mysqli_real_escape_string($con, $_POST["Username"]);
$email = mysqli_real_escape_string($con, $_POST["Email"]);
$pass = mysqli_real_escape_string($con, $_POST["Pass"]);
$confirm = mysqli_real_escape_string($con, $_POST["Confirm"]);

$query = "SELECT * FROM users WHERE Username = '".$name."'";

$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    // Username already exists
    $_SESSION["ERROR_Reg"] = "Username already exists";
    header("Location: register.php");
} else {
    if ($pass != $confirm) {
        // Password doesn't match
        $_SESSION["ERROR_Reg"] = "Your password doesn't match";
        header("Location: register.php");
    } else {
        // Generate hashed password and salt
        $hash = hash("sha256", $pass);
        $salt = md5(uniqid(rand(), true));
        $salt = substr($salt, 0, 3);
        $finalPass = hash("sha256", $hash.$salt);

        // Generate verification token
        $token = bin2hex(random_bytes(50));

        // Insert user data into pending_verification table
        $query = "INSERT INTO pending_verification (Username, Email, Password, Salt, RoleId, Token) 
                  VALUES ('".$name."', '".$email."', '".$finalPass."', '".$salt."', 2, '".$token."')";
        $result = mysqli_query($con, $query);
        if (!$result) {
            echo mysqli_error($con);
        } else {
            // Send verification email
            $verification_link = "http://yourdomain.com/verify.php?token=$token";
            $subject = "Email Verification";
            $message = "Please click the link below to verify your email address:\n\n$verification_link";
            $headers = "From: noreply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                $_SESSION["SUCCESS_Reg"] = "A verification email has been sent to $email. Please verify your email to complete registration.";
                header("Location: register.php");
            } else {
                echo "Failed to send verification email.";
            }
        }
    }
}
?>
