<?php
session_start();
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $coffee_id = $_POST['coffee_id'];
    $coffee_type = $_POST['coffee_type'];
    $coffee_size = $_POST['coffee_size'];
    $sugar_level = $_POST['sugar_level'];
    $quantity = $_POST['quantity'];

    // Delete the coffee items from the inventory table based on provided attributes
    $sql = "DELETE FROM inventory WHERE id = ? AND coffee_type = ? AND coffee_size = ? AND sugar_level = ? AND quantity = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssi", $coffee_id, $coffee_type, $coffee_size, $sugar_level, $quantity);
    $stmt->execute();

    // Check if any rows were affected (i.e., if any items were deleted)
    if ($stmt->affected_rows > 0) {
        // Set session variable for successful deletion message
        $_SESSION['delete_success'] = true;
    } else {
        // Set session variable for failure message
        $_SESSION['delete_failure'] = true;
    }

    $stmt->close();
    $conn->close();

    // Redirect back to the delete coffee form page
    header("Location: delete_coffee_form.html");
    exit();
} else {
    // Redirect if accessed directly without form submission
    header("Location: delete_coffee_form.html");
    exit();
}
?>
