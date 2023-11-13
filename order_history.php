<!-- order_history.php -->

<?php
session_start();

// To Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
// Including our database connection file
include("db_connection.php");

// Fetch tours in the order history
$user_id = $_SESSION["user_id"];
$cart_query = "SELECT o.tour_id, t.location, t.date, o.travelers
               FROM cart o
               JOIN tours t ON o.tour_id = t.id
               WHERE o.user_id = $user_id";
$cart_result = mysqli_query($conn, $cart_query);

// Check if there are tours in the cart
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
    <title>Order History</title>
</head>
<body>
    <h2>Order History</h2>
    
    <?php if (!empty($cart_tours)): ?>
        <ul>
            <?php foreach ($cart_tours as $cart_tour): ?>
                <li>
                    <strong><?php echo $cart_tour['location']; ?></strong>
                    <br>
                    Date: <?php echo $cart_tour['date']; ?>
                    <br>
                    Travelers: <?php echo $cart_tour['travelers']; ?>
                    <br>

                </li>
            <?php endforeach; ?>
        </ul>
        
        
    <?php else: ?>
        <p>no oreder yet..</p>
    <?php endif; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Big Button</title>
    <style>
        .big-button {
            display: inline-block;
            margin: 30px 0;
            padding: 15px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #2ecc71;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .big-button:hover {
            background-color: #27ae60;
        }
    </style>
</head>

<body>
    <a href="tours.php" class="big-button">Buy another tour</a>
</body>

</html>