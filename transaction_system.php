<?php
session_start();
include 'database.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Check if the form is submitted for inserting transactions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure proper validation and sanitization of form data
    // Extract form data
    $transactionID = $_POST['transactionID'];
    $date = $_POST['date'];
    $customer_perDay = $_POST['customer_perDay'];
    $product_sale_perDay = $_POST['product_sale_perDay'];
    $revenue_perDay = $_POST['revenue_perDay'];

    // Insert the data into the transaction_system table
    $sql = "INSERT INTO transaction_system (TransactionID, Date, customer_perDay, product_sale_perDay, Revenue_perDay) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiii", $transactionID, $date, $customer_perDay, $product_sale_perDay, $revenue_perDay);
    if ($stmt->execute()) {
        echo "Transaction added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <!-- Add your CSS file link here -->
</head>
<body>
    <header>
        <h1>Transactions</h1>
    </header>
    <main>
        <h2>Add Transaction</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="transactionID">Transaction ID:</label>
            <input type="number" id="transactionID" name="transactionID" required><br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>
            <label for="customer_perDay">Customers per Day:</label>
            <input type="number" id="customer_perDay" name="customer_perDay" required><br>
            <label for="product_sale_perDay">Product Sales per Day:</label>
            <input type="number" id="product_sale_perDay" name="product_sale_perDay" required><br>
            <label for="revenue_perDay">Revenue per Day:</label>
            <input type="number" id="revenue_perDay" name="revenue_perDay" required><br>
            <input type="submit" value="Add Transaction">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Coffee Shop</p>
    </footer>
</body>
</html>
