<!-- add_tour.php -->

<?php
session_start();

// To Check if the admin is logged in
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
    <title>Add New Tour</title>
</head>
<body>
    <h2>Add New Tour</h2>
    
    </form>
    <form action="add_tour_process.php" method="post">
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required>
    <br>
    <label for="date">Date:</label>
    <input type="date" id="date" name="date" required>

    <br>
    <label for="capacity">Capacity:</label>
    <input type="number" id="capacity" name="capacity" required>
    <br>
    <input type="submit" value="Add Tour">
</form>
<a href="admin_panel.php" class="button">Return to options</a>

</body>
</html>
