<!DOCTYPE html>
<html lang="en">
<?php include_once("Views/includes/header.php");?>

<?php include_once("Views/includes/nav.php");?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Edit Profile</h2>
            <form action="update_profile.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="CurrentUsername"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="user@example.com" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>

<?php  include_once("Views/includes/footer.php"); ?>