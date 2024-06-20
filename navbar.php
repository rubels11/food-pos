<?php
include "header.php";
require 'config.php';

    // Get the current page name
    $current_page = basename($_SERVER['PHP_SELF'], ".php");
   
?>
<section id="content">
		<!-- NAVBAR -->
		<nav>
			<a href="   <?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF'], ".php");

?>" class="nav-link"><?php echo ucfirst($current_page); ?></a>
			<a href="#" class="profile">
				<img src="images/people.jpeg">
				<a href="#" class="nav-user"> <?php
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo 'Guest';
                }
                ?></a>
			</a>
		</nav>
       </section>

	   
			
	

