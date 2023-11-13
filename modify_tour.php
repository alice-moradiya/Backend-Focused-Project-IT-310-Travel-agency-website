<!-- modify_tour.php -->

<?php
session_start();

// Check if the admin is logged in
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
    <title>Modify Tour</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Modify Tour</h2>

    <!-- HTML form for modifying tour details -->
    <form action="modify_tour_process.php" method="post">
        <!-- Include fields like tour ID, new location, new date, new capacity, etc. -->
        <label for="tour_id">Tour ID:</label>
        <input type="number" id="tour_id" name="tour_id" required>

        <label for="new_location">New Location:</label>
        <input type="text" id="new_location" name="new_location" required>

        <label for="new_date">New Date:</label>
        <input type="date" id="new_date" name="new_date" required>

        <label for="new_capacity">New Capacity:</label>
        <input type="number" id="new_capacity" name="new_capacity" required>

        <input type="submit" value="Modify Tour">
    </form>
    <a href="admin_panel.php" class="button">Return to options</a>

</body>
</body>
</html>