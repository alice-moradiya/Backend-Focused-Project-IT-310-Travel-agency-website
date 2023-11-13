<?php
// add_tour_process.php file

// Including our database connection file with an absolute path
include(__DIR__ . "/db_connection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $location = $_POST["location"];
    $date = $_POST["date"];
    $capacity = $_POST["capacity"];

    // to Check if the connection is successful
    if ($conn) {
        // To Insert the tour into the database
        $insert_query = "INSERT INTO tours (location, date, capacity) VALUES ('$location', '$date', '$capacity')";

        if (mysqli_query($conn, $insert_query)) {
            echo "Tour added successfully!";

        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Closing the connection
        mysqli_close($conn);
    } else {
        echo "Error connecting to the database.";
    }
}
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
    <a href="add_tour.php" class="big-button">Add another tour</a>
</body>

</html>