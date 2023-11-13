<?php
// login_process.php

// Including your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Checking user credentials
    $login_query = "SELECT * FROM users WHERE username = '$username'";
    $login_result = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_result) > 0) {
        $user_data = mysqli_fetch_assoc($login_result);

        // Verifying the password
        if (password_verify($password, $user_data["password"])) {
            session_start();
            $_SESSION["user_id"] = $user_data["id"];
            $_SESSION["username"] = $user_data["username"];
            header("Location: customer_choice.php");
        } else {
            echo "Invalid password. Please try again.";
        }
    } else {
        echo "User not found. Please register.";
    }

    mysqli_close($conn);
}
?>
