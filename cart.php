<!-- cart.php -->

<?php
session_start();

// Checking if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Including our database connection file
include("db_connection.php");

// Fetching tours in the shopping cart for the logged-in user
$user_id = $_SESSION["user_id"];
$cart_query = "SELECT c.tour_id, t.location, t.date, c.travelers
               FROM cart c
               JOIN tours t ON c.tour_id = t.id
               WHERE c.user_id = $user_id";
$cart_result = mysqli_query($conn, $cart_query);

// Checking if there are tours in the cart
if (mysqli_num_rows($cart_result) > 0) {
    $cart_tours = mysqli_fetch_all($cart_result, MYSQLI_ASSOC);
} else {
    $cart_tours = [];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>

<body>
    <h2>Shopping Cart</h2>

    <?php if (!empty($cart_tours)): ?>
        <ul>
            <?php foreach ($cart_tours as $cart_tour): ?>
                <li>
                    <strong>
                        <?php echo $cart_tour['location']; ?>
                    </strong>
                    <br>
                    Date:
                    <?php echo $cart_tour['date']; ?>
                    <br>
                    Travelers:
                    <?php echo $cart_tour['travelers']; ?>
                    <br>
                    <!-- Including a form to delete the tour from the cart -->
                    <form action="delete_from_cart.php" method="post">
                        <input type="hidden" name="tour_id" value="<?php echo $cart_tour['tour_id']; ?>">
                        <input type="submit" value="Delete from Cart">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Including a form to proceed to checkout -->
        <form action="checkout_process.php" method="post">
            <input type="submit" value="Proceed to Checkout">
        </form>
    <?php else: ?>
        <p>Your shopping cart is empty.</p>
    <?php endif; ?>
</body>
</html>
