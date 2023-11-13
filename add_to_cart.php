<?php
session_start();

// Checking if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Including your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $tour_id = $_POST["tour_id"];
    $travelers = $_POST["travelers"];

    // Checking if the tour is already in the cart
    $check_cart_query = "SELECT * FROM cart WHERE user_id = $user_id AND tour_id = $tour_id";
    $check_cart_result = mysqli_query($conn, $check_cart_query);

    if (mysqli_num_rows($check_cart_result) > 0) {
        echo "Tour already in the cart. You can modify the quantity in the shopping cart.";
    } else {
        // Checking if the number of travelers exceeds the tour capacity
        $check_capacity_query = "SELECT capacity FROM tours WHERE id = $tour_id";
        $check_capacity_result = mysqli_query($conn, $check_capacity_query);
        $tour_capacity = mysqli_fetch_assoc($check_capacity_result)['capacity'];

        if ($travelers <= $tour_capacity) {
            // Adding the tour to the cart
            $add_to_cart_query = "INSERT INTO cart (user_id, tour_id, travelers) VALUES ($user_id, $tour_id, $travelers)";

            if (mysqli_query($conn, $add_to_cart_query)) {
                // Redirecting to cart.php
                header("Location: cart.php");
                exit();
            } else {
                echo "Error: " . $add_to_cart_query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Number of travelers exceeds the tour capacity. Please select a lower quantity.";
        }
    }
}

mysqli_close($conn);
?>
