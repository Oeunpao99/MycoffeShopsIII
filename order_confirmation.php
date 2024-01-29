<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="add_coffe.css">
</head>
<body>
    <div class="container">
        <h2>Order Confirmation</h2>
        <?php
            // Start the session
            session_start();

            // Check if the order confirmation message is set in the session
            if (isset($_SESSION['order_confirmation'])) {
                echo '<p>' . $_SESSION['order_confirmation'] . '</p>';
                // Unset the session variable to remove the confirmation message
                unset($_SESSION['order_confirmation']);
            } else {
                // If the confirmation message is not set, display a generic message
                echo '<p>Your order has been placed successfully.</p>';
            }
        ?>
        <a href="menu.html">Back to Order Menu</a>
    </div>
</body>
</html>
