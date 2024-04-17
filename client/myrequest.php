<?php
session_start();
$username = $_SESSION["username"];
?>

<header class="header">
    <nav class="navbar navbar-expand-lg">
        <span class="navbar-brand">Event Planner MS</span>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="toggleSidebar()"><i class="fas fa-home"></i>Home</a>
                <div class="sidebar" id="sidebar">
                    <!-- Your sidebar links here -->
                </div>
            </li>
            <li class="nav-item">
                <span class="nav-link">Welcome, <?php echo $username; ?></span>
            </li>
        </ul>
    </nav>
</header>
