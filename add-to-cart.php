<?php
// Database connection parameters
$servername = "localhost"; // Change if your MySQL server is hosted elsewhere
$username = "root"; // Change to your MySQL username
$password = "Dec061204P@ssword"; // Change to your MySQL password
$database = "coffee_shop"; // Change if your database has a different name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Retrieve form data
$coffee_id = $_POST['coffee_id'];
$size = $_POST['size'];
$sugar_level = $_POST['sugar_level'];
$quantity = $_POST['quantity'];
$total_price = $quantity * getPriceBySize($size); // Calculate total price based on size

// Insert data into database
$sql = "INSERT INTO orders (coffee_id, size, sugar_level, quantity, total_price) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssi", $coffee_id, $size, $sugar_level, $quantity, $total_price);

if ($stmt->execute() === TRUE) {
    echo "Thanks for your order!";
    echo "<a href='home.html'> Go back to home</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close connection
$stmt->close();
$conn->close();

// Function to get price by size
function getPriceBySize($size) {
    switch($size) {
        case 'S':
            return 2;
        case 'M':
            return 3;
        case 'L':
            return 4;
        default:
            return 0;
    }
}
?>
