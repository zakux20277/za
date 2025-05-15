<?php
require_once 'includes/User.php';

if(isset($_POST['login'])) {
    $user = new User();
    if($user->login($_POST['username'], $_POST['password'])) {
        $_SESSION['message'] = 'Login successful!';
        $_SESSION['message_type'] = 'success';
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['message'] = 'Invalid username or password!';
        $_SESSION['message_type'] = 'danger';
    }
}

include 'views/partials/header.php';
?>

<div class="form-container">
    <h2>Login</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>