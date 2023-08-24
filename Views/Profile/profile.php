<!DOCTYPE html>
<html lang="en">
<?php include_once("Views/includes/header.php");?>

<?php include_once("Views/includes/nav.php");?>

<div class="container-fluid"">
<div class=" row">

    <nav id=" sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar mb-3">
        <div class="position-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="">Edit Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="settings.php">Settings</a>
                </li>
            </ul>
        </div>
    </nav>


    <main class=" col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>Edit Profile</h2>
        <?php if(isset($data['alert'])): ?>
        <div class="alert alert-<?= $data['alert']['type'] ?>"><?= $data['alert']['message'] ?></div>
        <?php endif; ?>

        <form action="<?= base_url() ?>/profile/update" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?= $data['user']['username'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $data['user']['email'] ?>"
                    required>
            </div>


            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </main>
</div>
</div>

<?php  include_once("Views/includes/footer.php"); ?>