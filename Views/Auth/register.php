<?php  include("Views/includes/header.php"); ?>


<div class="container mt-5">

    <h2>Register</h2>
    <?php if(isset($data['alert'])): ?>
    <div class="alert alert-<?= $data['alert']['type'] ?>"><?= $data['alert']['message'] ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group mb_3">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password2">Retype Password:</label>
            <input type="password" class="form-control" id="password2" name="password2" required>
        </div>
        <div class="form-group">
            <label for="isSeller">Register as Seller:</label>
            <input type="checkbox" id="isSeller" name="isSeller">
        </div>
        <div class="form-group">
            <a href="/ecommerce/auth/login">Not logged in? Log in</a>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?php  include("Views/includes/footer.php"); ?>