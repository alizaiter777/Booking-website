<?php
session_start();

if (isset($_SESSION["LoggedIN_Advisor"]) && $_SESSION["LoggedIN_Advisor"] == 1) {
    echo '<nav class="navbar">
    <div class="navbar-left">
       <ul>
          <li><a href="index.php">Home</a></li>
          
              <a href="Trail/ListTrail.php" class="dropbtn">Trails</a>
          </li>
          <li><a href="Blog/ListBlog.php">Blog</a></li>
         
          <li><a href="chat.php">contact</a></li>
       </ul>
    </div>

    <div class="navbar-right">
       <ul>
          <li><a href="profile.php" >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                 <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4-3a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM2 13s-1 0-1-1 1-4 7-4 7 3 7 4-1 1-1 1H2zm1-1h10c-.002-1-4-2-5-2s-5 1-5 2z"/>
              </svg> 
          </a></li>
        
          <li><a href="logout.php">Logout</a></li>
       </ul>
    </div>
    </nav>';
} else {
    
    header("Location: login.php");
    exit();
}
?>
