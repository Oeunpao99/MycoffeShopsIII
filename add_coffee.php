<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $coffee_type = $_POST['coffee_type'];
    $coffee_size = $_POST['coffee_size'];
    $sugar_level = $_POST['sugar_level'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Validate input if necessary
    // Add your validation logic here (e.g., check for empty fields, validate quantity format)

    // Insert data into the inventory table
    $sql = "INSERT INTO inventory (coffee_type, coffee_size, sugar_level, quantity, price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $coffee_type, $coffee_size, $sugar_level, $quantity, $price);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect to the inventory management page with a success message
    header("Location: inventory.html?success=1");
    exit();
} else {
    // Redirect to the add coffee form if accessed directly
    header("Location: add_coffee_form.html");
    exit();
}
?>
