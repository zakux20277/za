<?php require_once 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand"><?php echo SITE_NAME; ?></a>
            <ul class="navbar-nav">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php" class="nav-link">Dashboard</a></li>
                    <li><a href="services.php" class="nav-link">Services</a></li>
                    <li><a href="orders.php" class="nav-link">Orders</a></li>
                    <li><a href="logout.php" class="nav-link">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="nav-link">Login</a></li>
                    <li><a href="register.php" class="nav-link">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>