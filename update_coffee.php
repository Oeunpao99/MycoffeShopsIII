<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    $coffee_size = $_POST['coffee_size'];
    $sugar_level = $_POST['sugar_level'];

    // Update coffee details in the inventory table
    $sql = "UPDATE inventory SET quantity = ?, coffee_size = ?, sugar_level = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $quantity, $coffee_size, $sugar_level, $id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Coffee details updated successfully, set a session variable for alert message
        $_SESSION['update_success'] = true;
    }
    
    $stmt->close();
    $conn->close();

    // Redirect to the inventory management page or confirmation page
    header("Location: inventory.html");
    exit();
} else {
    // Redirect to the update coffee form if accessed directly
    header("Location: update_coffee_form.html");
    exit();
}
?>
