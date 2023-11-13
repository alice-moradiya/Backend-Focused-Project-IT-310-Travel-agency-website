<!-- update_profile_process.php -->

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
    $new_email = $_POST["email"];
    $new_phone = $_POST["phone"];

    // Updating user information in the database
    $update_query = "UPDATE users SET email = '$new_email', phone = '$new_phone' WHERE id = $user_id";

    if (mysqli_query($conn, $update_query)) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

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
    <a href="tours.php" class="big-button">Return to add tour</a>
</body>

</html>
