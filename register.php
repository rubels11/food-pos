<?php
require 'config.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required form fields are set
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

        // Check if the username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Username or email already exists.";
        } else {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Please fill in all required fields.";
    }
}
?>

<form method="post" action="register.php">
    Username: <input type="text" name="username" required>
    Email: <input type="email" name="email" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
