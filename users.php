<?php
// Include header and config files
include "header.php";
include "sidebar.php";
include "navbar.php";
require 'config.php';

// Fetch all users and their registration timestamps from the database
$sql = "SELECT id, username, email, created_at FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

</head>
<body>
<section id="content">
<div class="row">

    <table id="user">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Registration Timestamp</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all users and their registration timestamps from the database
            $sql = "SELECT id, username, email, created_at FROM users";
            $result = $conn->query($sql);

            // Check if there are any results
            if ($result->num_rows > 0) {
                // Output data for each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                    echo "<td>";
                    echo "<button class='update-button' data-toggle='modal' data-target='#updateModal' data-id='" . htmlspecialchars($row["id"]) . "' data-username='" . htmlspecialchars($row["username"]) . "' data-email='" . htmlspecialchars($row["email"]) . "'>Update</button> ";
                    echo "<button class='delete-button' data-toggle='modal' data-target='#deleteModal' data-id='" . htmlspecialchars($row["id"]) . "'>Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }
            // Close the connection
            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateModalLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="updateForm" action="update_user_action.php" method="POST">
            <div class="modal-body">
              <input type="hidden" id="update-user-id" name="user_id">
              <div class="form-group">
                <label for="update-username">Username</label>
                <input type="text" class="form-control" id="update-username" name="username" required>
              </div>
              <div class="form-group">
                <label for="update-email">Email</label>
                <input type="email" class="form-control" id="update-email" name="email" required>
              </div>
              <div id="update-success-message" class="success-message" style="display:none;">
                User updated successfully.
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="delete-button" data-dismiss="modal">Close</button>
              <button type="submit" class="update-button">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="deleteForm" action="delete_user.php" method="POST">
            <div class="modal-body">
              <input type="hidden" id="delete-user-id" name="user_id">
              <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $('#updateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');
            var username = button.data('username');
            var email = button.data('email');

            var modal = $(this);
            modal.find('#update-user-id').val(userId);
            modal.find('#update-username').val(username);
            modal.find('#update-email').val(email);
        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var userId = button.data('id');

            var modal = $(this);
            modal.find('#delete-user-id').val(userId);
        });
        function openUpdateModal(user) {
            document.getElementById('update-user-id').value = user.id;
            document.getElementById('update-username').value = user.username;
            document.getElementById('update-email').value = user.email;
            $('#updateModal').modal('show');
        }

        $(document).ready(function() {
            $('#updateForm').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'update_user_action.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#update-success-message').show();
                    },
                    error: function() {
                        alert('Failed to update user');
                    }
                });
            });

            $('#updateModal').on('hidden.bs.modal', function () {
                $('#update-success-message').hide(); // Hide success message on modal close
            });
        });
    </script>
</body>
</html>
