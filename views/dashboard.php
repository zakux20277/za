<?php
require_once 'includes/User.php';
require_once 'includes/Order.php';

$user = new User();
if(!$user->isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$userData = $user->getUser($_SESSION['user_id']);
$order = new Order();
$userOrders = $order->getUserOrders($_SESSION['user_id']);

include 'views/partials/header.php';
?>

<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($userData['username']); ?>!</h2>
    
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Balance</h3>
            <div class="stat-value">$<?php echo number_format($userData['balance'], 2); ?></div>
        </div>
        <div class="stat-card">
            <h3>Total Orders</h3>
            <div class="stat-value"><?php echo count($userOrders); ?></div>
        </div>
    </div>

    <h3>Recent Orders</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Service</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($userOrders as $order): ?>
                <tr>
                    <td>#<?php echo $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['service_name']); ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td>$<?php echo number_format($order['price'], 2); ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td><?php echo date('Y-m-d H:i', strtotime($order['created_at'])); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>