<!-- dashboard.php -->

<?php
session_start();

// Checking if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Including your database connection file
include("db_connection.php");

// Fetching user information for the logged-in user
$user_id = $_SESSION["user_id"];
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);

// Checking if the user exists
if (mysqli_num_rows($user_result) == 1) {
    $user_data = mysqli_fetch_assoc($user_result);
} else {
    $user_data = [];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<!-- Css file -->
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        header {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
        }

        nav {
            margin-bottom: 20px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        nav a:hover {
            color: #ff4500;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-top: 20px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        form button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }
    </style>

<head>
    <title>Fast Travel</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale= 1.0, user-scalable=no" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="inner">

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="12">
        <div class="container-fluid">
            <a id="logo1" class="navbar-brand" href="main.html"><img src="logo.jpg" alt="Logo" width="200" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="main.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_login.php">Login</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
<!-- Profile info -->
        <?php if (!empty($user_data)): ?>
            <h3>Your Information</h3>
            <table>
                <tr>
                    <th>Username</th>
                    <td><?php echo $user_data['username']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $user_data['email']; ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo $user_data['phone']; ?></td>
                </tr>
                <!-- Add more fields as needed -->
            </table>

            <!-- Form to update user information -->
            <h3>Update Information</h3>
            <form action="update_profile_process.php" method="post">
                <label for="email">New Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
                <label for="phone">New Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" required>
                <!-- Add more fields as needed -->
                <button type="submit">Update Profile</button>
            </form>
            <a href="customer_choice.php" class="button">Return to options</a>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>

    <div class="footer">
        &copy; 2023 FastTravel | All rights reserved
    </div>
    <footer class="container" id="dev1">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>Copyright © 2023-2026 Fast Travel. All Rights Reserved.  <a href="#">Privacy</a> · <a href="#">Terms</a>  </p>
        <p id="dev2"> Site is developed by Alice Moradiya & Drij Gajera </p>
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

</body>
</html>


