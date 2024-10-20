<?php
session_start();
if(isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] == 1){
	
   echo '<nav class="navbar">
   <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="#">Sports</a></li>
    
    <li class="dropdown">
        <a href="#" class="dropbtn">Trails </a>
        <div class="dropdown-content">
            <a href="#">North Lebanon</a>
            <a href="#">East Lebanon</a>
            <a href="#">South Lebanon</a>
        </div>

    </li>
    <li><a href="#">Blog</a></li>
    <li><a href="#">Services</a></li>

    
    <li><a href="#">News & Achievments</a></li>
    <li><a href="logout.php">Logout</a></li>
   


</ul>
</nav>
';
}
else
echo '<nav class="navbar">
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="#">Sports</a></li>
    
    <li class="dropdown">
        <a href="#" class="dropbtn">Trails </a>
        <div class="dropdown-content">
            <a href="#">North Lebanon</a>
            <a href="#">East Lebanon</a>
            <a href="#">South Lebanon</a>
        </div>

    </li>
    <li><a href="#">Blog</a></li>
    <li><a href="#">Services</a></li>

    
    <li><a href="#">News & Achievments</a></li>
    <li><a href="login.php">Login</a></li>
</ul>
</nav>
';
?>