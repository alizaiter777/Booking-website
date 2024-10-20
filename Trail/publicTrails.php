<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Hikes Review Page</title>
    <link rel="stylesheet" href="public.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
   

    <main>
    <header>
        <div class="container1">
        <h2>Find Your Next Adventure</h2>
            <h1>Join our community of hikers and explore new trails.</h1>
            
        </div>
    </header>
         
            <?php
require("Config.php");
$query = "SELECT T.Id, T.Name, T.Price, T.CatId, T.Image, T.PageUrl, T.Location, T.Sport, T.Difficulty, C.Name AS CatName 
          FROM trail T
          INNER JOIN trialcategory C ON T.CatId = C.Id 
          WHERE T.CatId = 1";
$result = mysqli_query($con, $query);


$trialCounter = 0;

while ($row = mysqli_fetch_array($result)) {
    
    if ($trialCounter % 3 == 0) {
        echo '<div class="row">';
    }
    ?>
    <div class="container" style="font-family: poppins, sans-serif;">
        <div class="image-container " style="padding-left: 20px;">
        <div class="column" onclick="goToTrialPage(<?= $row['Id'] ?>)">
                <a href="trailinfo.php?id=<?= $row['Id'] ?>">
                    <img class="zoom-image" src="../Uploads/<?= $row['Image'] ?>" width="300" height="400">
                </a>
                    <?= $row["Name"] ?>

                    <p style="font-size:small;color: #666; ">
                    
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#666" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                        </svg>
                    
                    
                   <span>  <?= $row["Location"] ?> 
                   <span style="float: right;"> <?= $row["Sport"] ?></span>
                </span>
                    
                       
                    <br> <br>
                    <span style="color:#666;font-size: large; "><b>USD <?= $row["Price"] ?> / </b>
                        <span style="font-size: small;">Pers</span>
                    </span>
                </p>
            </div>
        </div>
    </div>
    <?php
   
    if (($trialCounter + 1) % 3 == 0 || $row === end($result)) {
        echo '</div>';
    }

   
    $trialCounter++;
}

?>
 

 <script>
    function goToTrialPage(id) {
        window.location.href = 'trailinfo.php?id=' + id;
    }
</script>



            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Community Hikes. All rights reserved.</p>
    </footer>
</body>
</html>