<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}

// Include your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $tour_id = $_POST["tour_id"];
    $new_location = $_POST["new_location"];
    $new_date = $_POST["new_date"];
    $new_capacity = $_POST["new_capacity"];

    // Update tour information in the database
    $update_query = "UPDATE tours SET location = '$new_location', date = '$new_date', capacity = '$new_capacity' WHERE id = $tour_id";

    if (mysqli_query($conn, $update_query)) {
        // Redirect back to modify_tour.php with a success message
        header("Location: modify_tour.php?success=true");
    } else {
        // Redirect back to modify_tour.php with an error message
        header("Location: modify_tour.php?success=false");
    }
} else {
    // Redirect back to modify_tour.php if accessed without a POST request
    header("Location: modify_tour.php");
}

mysqli_close($conn);
?>