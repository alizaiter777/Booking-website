<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
    <?php 
    
    require_once("Config.php"); 
   
    ?>

    <?php
    
   
       $name=""; $nameError="";
       $price=""; $priceError="";
    
       $location=""; $locationError="";
       $sport=""; $sportError="";
       $difficulty=""; $difficultyError="";

		
      $id = $_GET["Id"];		
       $query = "SELECT * FROM trail WHERE ID = '$id'";
		$result = mysqli_query($con, $query);
		while( $row = mysqli_fetch_array($result) ) {
            $name = $row["Name"];
            $price = $row["Price"];
            $location = $row["Location"];
            $sport = $row["Sport"];
            $difficulty = $row["Difficulty"];

		}


		
        if(isset($_POST["btnSave"])){ 
           
            $name = $_POST["txtName"];
            $price = $_POST["txtPrice"];
            $location = $_POST["txtLocation"];
            $sport = $_POST["txtSport"];
            $difficulty = $_POST["txtDifficulty"];
            $isValid = true;
                  
           if($name==""){
                $nameError = "Enter a value";
                $isValid = false;
           }
            else
                 $nameError = "";
          
           if($price == "" || !is_numeric($price) || $price <= 0){
                $priceError = "Enter a valid price";
                $isValid = false;
            }
            else
                    $priceError = "";
                     if($location==""){
                        $locationError = "Enter a value";
                        $isValid = false;
                   }
                    else
                         $locationError = "";
                         if($sport==""){
                            $sportError = "Enter a value";
                            $isValid = false;
                       }
                        else
                             $sportError = "";
                             if($difficulty==""){
                                $difficultyError = "Enter a value";
                                $isValid = false;
                           }
                            else
                                 $difficultyError = "";


            if($isValid){ 
                              
                $query  = "UPDATE trail SET Name='$name', Price = '$price'  , Location='$location' ,Sport='$sport',Difficulty='$difficulty' WHERE Id = $id";
                $result = mysqli_query($con, $query);
                header("Location: ListTrail.php"); 
            }

        }
        
    ?>
    <form method="post" action="">
    Tail Name <input type="text" name="txtName" 
                            value="<?php echo $name; ?>" />
        <label style="color:red"><?php echo $nameError; ?></label> <br/>

         Price <input type="number" name="txtPrice" 
                            value="<?php echo $price; ?>" />
        <label style="color:red"><?php echo $priceError; ?></label> <br/>

       

                           Location <input type="text" name="txtLocation" 
                            value="<?php echo $location; ?>" />
                               <label style="color:red"><?php echo $locationError; ?></label> <br/>

                           Sport <input type="text" name="txtSport" 
                            value="<?php echo $sport; ?>" />
                            <label style="color:red"><?php echo $sportError; ?></label> <br/>

                             Difficulty <input type="number" name="txtDifficulty" 
                            value="<?php echo $difficulty; ?>" />
                            <label style="color:red"><?php echo $difficultyError; ?></label> <br/>
                            <br/>
        <input type="Submit" name="btnSave" value="Save" />
        <input type="Reset" value="Clear" />
    </form> 
</body>
