<?php
// Include header and config files
include "header.php";
include "sidebar.php";
include "navbar.php";
require 'config.php';

// Fetch all users and their registration timestamps from the database
$sql = "SELECT username, email, created_at FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .data-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .data-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<section id="content">

    <table class="data-table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Registration Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data for each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No users found</td></tr>";
            }
            // Close the connection
            $conn->close();
            ?>
        </tbody>
    </table>
    </section>
</body>
</html>
