<?php 
include "header.php";
require 'config.php';
?>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <i class="fa-solid fa-utensils"></i>
        <span class="text">Food POS</span>
        </a>
        <ul class="side-menu top">
<li>
    <a href="dashboard.php"> 
    <i class="fa-solid fa-chart-pie"></i>
    <span class="text">Dashboard</span>
    </a>
</li>
<li>
    <a href="#"> 
    <i class="fa-solid fa-bowl-food"></i>
    <span class="text">Cuisine</span>
    </a>
</li>
<li>
    <a href="#"> 
    <i class="fa-solid fa-book"></i>
    <span class="text">Orders</span>
    </a>
</li>
<li>
    <a href="users.php"> 
    <i class="fa-regular fa-user"></i>
    <span class="text">Users</span>
    </a>
</li>
<li class="side-menu bottom">
    <a href="#"> 
    <i class="fa-solid fa-gear"></i>
    <span class="text">Settings</span>
    </a>
</li>
<li>
    <a href="logout.php"> 
    <i class="fa-solid fa-right-from-bracket"></i>
    <span class="text">Logout</span>
    </a>
</li>
</ul>
</section>

</body>
</html>