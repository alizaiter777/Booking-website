<!DOCTYPE html>
<html>
    <head>
<link rel="stylesheet" href="navbar.css"/>
<link rel="stylesheet" href="trailinfo.css"/>

    <title> my page</title>

   
</head>

    <body>
    <?php
include("authentication.php");
require("Config.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $trailId = intval($_GET['id']);
    
    $query = "SELECT T.Id, T.Name, T.Price, T.CatId, T.Image, T.PageUrl, T.Location, T.Sport, T.Difficulty,T.Discription	 FROM trail T WHERE T.Id = $trailId";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $trail = mysqli_fetch_assoc($result);
    } else {
        echo "Tour not found.";
        exit;
    }
    mysqli_close($con);
} else {
    echo "Invalid tour ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($trail["Name"]) ?></title>
    <style>
        /* Add your CSS here */
    </style>
</head>
<body>
    
    <div class="container" style="font-family: poppins, sans-serif; color: #666;">
        <div class="left-container" style="padding-right: 40px;">
            <p style="font-size: medium; text-align: left;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                </svg>
                <?= htmlspecialchars($trail["Location"]) ?>
                <span style="color: black; font-size: x-large; float: right;">
                    <b>USD<?= htmlspecialchars($trail["Price"]) ?> </b><span style="font-size: small;">Pers</span>
                </span>
            </p>
            <p style="font-size: xx-large; color: black;">
                <b><?= htmlspecialchars($trail["Name"]) ?></b>
                <span style="float: right;">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#666" viewBox="0 0 16 16">
                    <path d="M0 0h1v16H0V0zm2 1.5c0-.276.223-.5.5-.5h10c.384 0 .74.184.961.516.217.327.287.747.187 1.135L11.666 8l1.982 4.349c.1.388.03.808-.187 1.135A1.5 1.5 0 0 1 12.5 14h-10a.5.5 0 0 1-.5-.5v-12zM2 1h10c.245 0 .484.117.636.316.153.2.207.456.144.707L11.256 7.5h.994c.245 0 .484.117.636.316.153.2.207.456.144.707l-1.796 3.949c-.063.25-.219.464-.434.601A1 1 0 0 1 10.5 13H2V1z"/>
                </svg>
                <span style="font-size: large; color: #666;"> <?= htmlspecialchars($trail["Sport"]) ?></span></br>
                <span style="font-size: large; color: #666;">      difficulty           <?= htmlspecialchars($trail["Difficulty"]) ?>
</span>


                </span>
            </p>
            <img style="width: 750px;" src="../Uploads/<?= htmlspecialchars($trail["Image"]) ?>" height="510px">
        </div>
        <div class="right-container" style="height: 60%;">
            <table class="form-table">
                <h2>Details</h2>
               <p style="font-size:20px"> <?= htmlspecialchars($trail["Discription"]) ?></p>
            
            <?php if (isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] == 1) {
    $userId = $_SESSION["UserId"]; // Assuming you store userId in session
    echo '<div class="btn">
            <a href="reserv.php?trailId=' . htmlspecialchars($trail["Id"]) . '&userId=' . htmlspecialchars($userId) . '" class="button">Book Now</a>
          </div>';
} else {
    echo '<div  class="btn">Login to Book Trail</div>';
} ?>
</table>
        </div>
    </div> 
</body>
</html>

            
   

