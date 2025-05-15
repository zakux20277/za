<?php
require_once 'includes/User.php';

if(isset($_POST['register'])) {
    $user = new User();
    try {
        $user->register($_POST['username'], $_POST['email'], $_POST['password']);
        $_SESSION['message'] = 'Registration successful! Please login.';
        $_SESSION['message_type'] = 'success';
        header('Location: login.php');
        exit();
    } catch(Exception $e) {
        $_SESSION['message'] = 'Registration failed! ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    }
}

include 'views/partials/header.php';
?>

<div class="form-container">
    <h2>Register</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>