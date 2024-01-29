<?php
session_start();
include 'database.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Add your change password functionality here

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Add your CSS file link here -->
</head>
<body>
    <header>
        <h1>Change Password</h1>
    </header>
    <main>
        <!-- Add your change password interface here -->
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop</p>
    </footer>
</body>
</html>
