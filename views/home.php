<?php
require_once 'includes/Service.php';

$service = new Service();
$categories = $service->getAllCategories();
$services = $service->getAllServices();

include 'views/partials/header.php';
?>

<div class="home">
    <div class="hero">
        <h1>Welcome to <?php echo SITE_NAME; ?></h1>
        <p>Get high-quality social media services at the best prices!</p>
    </div>

    <div class="services-section">
        <h2>Our Services</h2>
        <div class="services-grid">
            <?php foreach($services as $service): ?>
            <div class="service-card">
                <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
                <div class="service-price">
                    $<?php echo number_format($service['price'], 2); ?> per 1000
                </div>
                <p>Min: <?php echo $service['min_quantity']; ?> - Max: <?php echo $service['max_quantity']; ?></p>
                <?php if(isset($_SESSION['user_id'])): ?>
                <a href="order.php?service=<?php echo $service['id']; ?>" class="btn btn-primary">Order Now</a>
                <?php else: ?>
                <a href="login.php" class="btn btn-primary">Login to Order</a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>