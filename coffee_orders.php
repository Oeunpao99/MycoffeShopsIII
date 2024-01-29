<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $coffee_type = $_POST['coffee_type'];
    $coffee_size = $_POST['coffee_size']; // Added coffee size
    $sugar_level = $_POST['sugar_level']; // Added sugar level
    $quantity = $_POST['quantity'];

    // Check inventory availability (Assuming you have an inventory table)
    $sql = "SELECT * FROM inventory WHERE coffee_type = ? AND quantity >= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $coffee_type, $quantity);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Coffee is available, deduct inventory and process order
        $row = $result->fetch_assoc();
        // Deduct inventory
        $new_quantity = $row['quantity'] - $quantity;
        // Update inventory
        $update_sql = "UPDATE inventory SET quantity = ? WHERE coffee_type = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("is", $new_quantity, $coffee_type);
        $update_stmt->execute();
        $update_stmt->close();

        // Insert the order into the coffee_orders table
        $insert_sql = "INSERT INTO coffee_orders (coffee_type, coffee_size, sugar_level, quantity) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssi", $coffee_type, $coffee_size, $sugar_level, $quantity);
        $insert_stmt->execute();
        $insert_stmt->close();

        // Set order confirmation message in session
        $_SESSION['order_confirmation'] = "Your order for $quantity cups of $coffee_size $coffee_type with $sugar_level sugar level has been placed successfully.";

        // Redirect to the order confirmation page
        header("Location: order_confirmation.php");
        exit();
    } else {
        // Coffee is not available
        echo "Sorry, the selected coffee is not available in the desired quantity.";
    }
    $stmt->close();
    $conn->close();
} else {
    // Redirect to the order menu page if accessed directly
    header("Location: order_menu.html");
    exit();
}
?>
