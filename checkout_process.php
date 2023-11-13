<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
// estlablishing connections
include("db_connection.php");

$user_id = $_SESSION["user_id"];

$cart_query = "SELECT * FROM cart WHERE user_id = $user_id";
$cart_result = mysqli_query($conn, $cart_query);

if (mysqli_num_rows($cart_result) > 0) {
    mysqli_autocommit($conn, false);

    $success = true;

    while ($cart_item = mysqli_fetch_assoc($cart_result)) {
        $tour_id = $cart_item['tour_id'];
        $travelers = $cart_item['travelers'];
        $location_id = $cart_item['location_id'];

        $decrease_capacity_query = "UPDATE tours SET capacity = capacity - $travelers WHERE id = $tour_id";
        if (!mysqli_query($conn, $decrease_capacity_query)) {
            $success = false;
            break;
        }

        $insert_order_query = "INSERT INTO orders (user_id, tour_id, travelers, location_id) VALUES ($user_id, $tour_id, $travelers, $location_id)";
        if (!mysqli_query($conn, $insert_order_query)) {
            $success = false;
            break;
        }
    }

    if ($success) {
        mysqli_commit($conn);

        $clear_cart_query = "DELETE FROM cart WHERE user_id = $user_id";
        mysqli_query($conn, $clear_cart_query);

        echo "Checkout successful. Items moved to order history.";
    } else {
        mysqli_rollback($conn);
        echo "Error during checkout. Please try again.";
    }

    mysqli_autocommit($conn, true);
    header("Location: order_history.php");
    exit();
} else {
    echo "No items in the shopping cart.";
}

mysqli_close($conn);
?>
