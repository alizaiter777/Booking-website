<?php
$value = $_GET["Name"]; // sent from ajax data
require("Config.php");

$query = "SELECT T.Id, T.Name, T.Price, T.CatId, T.Image, T.PageUrl, T.Location, T.Sport, T.Difficulty, C.Name AS CatName 
          FROM trial T
          INNER JOIN trialcategory C ON T.CatId = C.Id 
    WHERE T.CatId = 1 AND T.Name LIKE '%$value%'";

$result = mysqli_query($con, $query);

// Counter to keep track of trips in a row
$trialCounter = 0;

while ($row = mysqli_fetch_array($result)) {
    // Start a new row for every third trip
    if ($trialCounter % 3 == 0) {
        echo '<div class="row">';
    }
    ?>
    <div class="container" style="font-family: poppins, sans-serif;">
        <div class="image-container" style="padding-left: 20px;">
            <div class="column" onclick="goToTrialPage('<?= $row["PageUrl"] ?>')">
            
                <a href="<?= $row["PageUrl"] ?>">
                
                    <img class="zoom-image" src="Uploads\<?= $row["Image"] ?>" width="300" height="350">
                    </a>
                    <?= $row["Name"] ?>

                    <p style="font-size:small;color: #666; ">
                    
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#666" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                        </svg>
                    
                    
                   <span>  <?= $row["Location"] ?> 
                   <span style="padding-right:20px"> <?= $row["Sport"] ?></span>
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
    function goToTrialPage(pageUrl) {
        
        window.location.href = pageUrl;
    }
</script>
