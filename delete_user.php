<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $user_id = $_POST["id"];

    // Prepare the SQL statement to avoid SQL injection
    $sql = "DELETE FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Error deleting user: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Error preparing statement: " . $conn->error]);
    }

    $conn->close();
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
