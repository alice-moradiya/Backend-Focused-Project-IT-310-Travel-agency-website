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

    // To Delete the tour from the cart
    $delete_query = "DELETE FROM cart WHERE user_id = $user_id AND tour_id = $tour_id";

    if (mysqli_query($conn, $delete_query)) {
        header("Location: cart.php");
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>