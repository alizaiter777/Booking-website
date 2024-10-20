<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    require_once("Config.php"); ?> 
    <h1>Add Trail</h1>
    
    <?php
        $name=""; $nameError="";
        $price=""; $priceError="";
        $cat=""; $catError="";
        $image = ""; $imageError = "";
        $pageUrl=""; $pageUrlError="";
        $location=""; $locationError="";
        $sport=""; $sportError="";
        $difficulty=""; $difficultyError="";

        if(isset($_POST["btnSave"])){ 
           
           $name = $_POST["txtName"];
           $price = $_POST["txtPrice"];
           $cat = isset($_POST["cat"]) ? $_POST["cat"] : ""; // Ensure cat is set
           $image = $_FILES["Image"]["name"];
           $pageUrl = $_POST["txtPageUrl"];
           $location = $_POST["txtLocation"];
           $sport = $_POST["txtSport"];
           $difficulty = $_POST["txtDifficulty"];
           $isValid = true;
           
           if($name == ""){
                $nameError = "Enter a value";
                $isValid = false;
           } else {
                $nameError = "";
           }
           
           if($price == "" || !is_numeric($price) || $price <= 0){
                $priceError = "Enter a valid price";
                $isValid = false;
           } else {
                $priceError = "";
           }

           $allowedExts = array("gif", "jpeg", "jpg", "png");
           $extension = strtolower(pathinfo($_FILES["Image"]["name"], PATHINFO_EXTENSION));
           if (($_FILES["Image"]["size"] > 500000) || !in_array($extension, $allowedExts)){
                $imageError = "Image is not accepted";
                $isValid = false;
           } else {
                $imageError = "";
           }

           if($pageUrl == "") {
                $pageUrlError = "Enter a value";
                $isValid = false;
           } else {
                $pageUrlError = "";
           }

           if($location == "") {
                $locationError = "Enter a value";
                $isValid = false;
           } else {
                $locationError = "";
           }

           if($sport == "") {
                $sportError = "Enter a value";
                $isValid = false;
           } else {
                $sportError = "";
           }

           if($difficulty == "" || !is_numeric($difficulty) || $difficulty <= 0) {
                $difficultyError = "Enter a valid difficulty";
                $isValid = false;
           } else {
                $difficultyError = "";
           }

           if($cat == "") {
                $catError = "Select a category";
                $isValid = false;
           } else {
                $catError = "";
           }

           if($isValid){
                $img_new_name = rand() . $image; 
                move_uploaded_file($_FILES["Image"]["tmp_name"], "../Uploads/" . $img_new_name);
                $query = "INSERT INTO trail(Name, Price, CatId, Image, PageUrl, Location, Sport, Difficulty) 
                          VALUES ('$name', '$price', '$cat', '$img_new_name', '$pageUrl', '$location', '$sport', '$difficulty')";
                $result = mysqli_query($con, $query);
                if ($result) {
                    header("Location: ListTrail.php");
                } else {
                    echo "Error: " . mysqli_error($con);
                }
           }
        }
    ?>
    <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Trail Name <input type="text" name="txtName" value="<?php echo $name; ?>" />
        <label style="color:red"><?php echo $nameError; ?></label> <br/>

        Price <input type="number" name="txtPrice" value="<?php echo $price; ?>" />
        <label style="color:red"><?php echo $priceError; ?></label> <br/>

        Category <select name="cat">
            <option value="">Select Category</option>
            <?php
                $query = "SELECT * FROM trialcategory";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)){
                    $id = $row["ID"];
                    $catname = $row["Name"];                            
                    if($cat == $id) {
                        echo "<option value='$id' selected>$catname </option>";
                    } else {
                        echo "<option value='$id'>$catname </option>";
                    }
                }
            ?>
        </select>
        <label style="color:red"><?php echo $catError; ?></label> <br/>

        PageUrl <input type="text" name="txtPageUrl" value="<?php echo $pageUrl; ?>" />
        <label style="color:red"><?php echo $pageUrlError; ?></label> <br/>

        Location <input type="text" name="txtLocation" value="<?php echo $location; ?>" />
        <label style="color:red"><?php echo $locationError; ?></label> <br/>

        Sport <input type="text" name="txtSport" value="<?php echo $sport; ?>" />
        <label style="color:red"><?php echo $sportError; ?></label> <br/>

        Difficulty <input type="number" name="txtDifficulty" value="<?php echo $difficulty; ?>" />
        <label style="color:red"><?php echo $difficultyError; ?></label> <br/>
        
        Image <input type="file" name="Image" />
        <label style="color:red"><?php echo $imageError; ?></label> <br/>

        <br/>
        <input type="Submit" name="btnSave" value="Save" />
        <input type="Reset" value="Clear" />
    </form> 
</body>
</html>
