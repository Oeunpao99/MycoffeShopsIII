<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection file
include 'database.php';

// Fetch inventory data from the database
$sql = "SELECT * FROM inventory"; // Adjust the fields as necessary
$result = $conn->query($sql);

// Start the HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <link rel="stylesheet" href="tableforUser.css"> <!-- Link to your CSS file -->
</head>
<body>';

// Check if we got any results
if ($result && $result->num_rows > 0) {
    // Open the table
    echo '<table>
            <tr>
                <th>ID</th>
                <th>Coffee Type</th>
                <th>Size</th>
                <th>Sugar Level</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>';

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row["id"]) . '</td>
                <td>' . htmlspecialchars($row["coffee_type"]) . '</td>
                <td>' . htmlspecialchars($row["coffee_size"]) . '</td>
                <td>' . htmlspecialchars($row["sugar_level"]) . '</td>
                <td>' . htmlspecialchars($row["quantity"]) . '</td>
                <td>' . htmlspecialchars($row["price"]) . '</td>
              </tr>';
    }

    // Close the table
    echo '</table>';
} else {
    echo "0 results";
}

// Close the HTML output
echo '</body>
</html>';
echo '  <button><a href="menu.html"> Back to Main Menu</a></button><a href="menu.html"></a>';
// Close the database connection
$conn->close();
?>
