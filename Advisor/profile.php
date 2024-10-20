<?php
session_start();
require("Config.php");

if (!isset($_SESSION["LoggedIN_Advisor"]) || $_SESSION["LoggedIN_Advisor"] != 1) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION["UserId_Advisor"];
$query = "SELECT Username, Email, Image FROM users WHERE Id='$userId'";
$result = mysqli_query($con, $query);

if (!$result) {
    die(mysqli_error($con));
}

$user = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        img {
            border-radius: 50%;
        }
    </style>
</head>
<body class="container">
    <h1>Profile Page</h1>
    <p>Username: <?php echo htmlspecialchars($user["Username"]); ?></p>
    <p>Email: <?php echo htmlspecialchars($user["Email"]); ?></p>
    <p>
        <img src="<?php echo htmlspecialchars($user["Image"]); ?>" alt="User Image" width="150" height="150">
    </p>

    <h2>Upload New Image</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <input type="submit" name="upload" value="Upload">
    </form>

    <?php
    if (isset($_SESSION["UPLOAD_ERROR"])) {
        echo "<p style='color:red'>" . $_SESSION["UPLOAD_ERROR"] . "</p>";
        unset($_SESSION["UPLOAD_ERROR"]);
    }

    if (isset($_SESSION["UPLOAD_SUCCESS"])) {
        echo "<p style='color:green'>" . $_SESSION["UPLOAD_SUCCESS"] . "</p>";
        unset($_SESSION["UPLOAD_SUCCESS"]);
    }
    ?>
</body>
</html>
