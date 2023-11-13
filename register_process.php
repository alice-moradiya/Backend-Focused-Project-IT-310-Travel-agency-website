<?php
// register_process.php

// Including your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Checking if the username is not taken
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Username already taken. Please choose another.";
    } else {
        // Inserting user data into the 'users' table
        $insert_query = "INSERT INTO users (username, password, email, phone) 
                        VALUES ('$username', '$password', '$email', '$phone')";

        if (mysqli_query($conn, $insert_query)) {
            header("Location: login.php");
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>
