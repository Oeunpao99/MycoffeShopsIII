<?php
session_start();
include 'database.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Add your coffee inventory management functionality here

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Add your CSS file link here -->
</head>
<body>
    <header>
        <h1>Inventory Management</h1>
    </header>
    <main>
        <section>
            <h2>Add Coffee to Inventory</h2>
            <form action="add_coffee.php" method="post">
                <label for="coffee_type">Coffee Type:</label>
                <input type="text" id="coffee_type" name="coffee_type" required><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required><br>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" required><br>
                <input type="submit" value="Add Coffee">
            </form>
        </section>

        <!-- Add sections for updating, deleting, and displaying coffee inventory -->
        <!-- Make sure to include forms and tables as needed -->

    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop</p>
    </footer>
</body>
</html>
