<!-- admin_panel.php -->

<?php
session_start();

// Checking if the admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["admin_username"]; ?>!</h2>    
    <!-- Displaying options for admin like adding new tours, modifying tour details. -->
    
    <a href="add_tour.php">Add New Tour</a>
    <br>
    <a href="modify_tour.php">Modify Tour</a>
    <br>

    <a href="main.html">Home</a>

</body>
</html>
