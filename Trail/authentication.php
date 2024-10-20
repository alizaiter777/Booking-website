
<?php
session_start();

if(isset($_SESSION["LoggedIN"]) && $_SESSION["LoggedIN"] == 1){
	
   echo '<nav class="navbar">
   <div class="navbar-left">
      <ul>
         <li><a href="../index.php">Home</a></li>
         </li>
      </ul>
   </div>

   <div class="navbar-right" style="margin-left:900px">
      <ul>
         <li><a href="../profile.php" >
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm4-3a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM2 13s-1 0-1-1 1-4 7-4 7 3 7 4-1 1-1 1H2zm1-1h10c-.002-1-4-2-5-2s-5 1-5 2z"/>
             </svg> 
         </a></li>
         <li><a href="../orders.php" >
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
                <path d="M10.854 6.854a.5.5 0 0 0-.708-.708L7.5 9.293 6.354 8.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                <path d="M3.5 0a.5.5 0 0 0 0 1H4v1a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V1h.5a.5.5 0 0 0 0-1h-9zM11 1H5v1h6V1z"/>
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm15 10V4H1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
             </svg> 
         </a></li>
         <li><a href="logout.php">Logout</a></li>
      </ul>
   </div>
</nav>

';
}
else
echo '<nav class="navbar">
<div class="navbar-left">
   <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="#sport">Sports</a></li>
      
      <li class="dropdown">
          <a href="#trail" class="dropbtn">Trails</a>
          <div class="dropdown-content">
              <a href="#">Public</a>
              <a href="#">Private</a>
              
          </div>
      </li>
      <li><a href="#blog">Blog</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#">News & Achievements</a></li>
   </ul>
</div>

<div class="navbar-right">
   <ul>
     <li><a href="login.php">Login</a></li>
   </ul>
</div>
</nav>
';
?>