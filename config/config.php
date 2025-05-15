<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'smm_panel');

// Site settings
define('SITE_NAME', 'SMM Panel');
define('SITE_URL', 'http://localhost');

// Session settings
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);