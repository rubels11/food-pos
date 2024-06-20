<?php
// Include header and config files
include "header.php";
include "sidebar.php";
include "navbar.php";
require 'config.php';



// Fetch user data from database
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<body>
<div class="container mt-5">
    <form id="profileForm">
        <div class="form-group">
            <label for="profile-username">Username</label>
            <input type="text" class="form-control" id="profile-username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div class="form-group">
            <label for="profile-email">Email</label>
            <input type="email" class="form-control" id="profile-email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div id="profile-success-message" class="success-message" style="display:none;">
            Profile updated successfully.
        </div>
        <div id="profile-error-message" class="error-message" style="display:none;">
            Failed to update profile.
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<script>
$(document).ready(function() {
    $('#profileForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: 'update_profile.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === "success") {
                    $('#profile-success-message').show();
                    setTimeout(function() {
                        $('#profile-success-message').hide();
                    }, 2000);
                } else {
                    $('#profile-error-message').text(response.message).show();
                }
            },
            error: function() {
                $('#profile-error-message').show();
            }
        });
    });
});
</script>
</body>
</html>
