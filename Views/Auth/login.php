<?php  include("Views/includes/header.php"); ?>

<div class="container mt-5">

    <h2>Login</h2>
    <?php if(isset($data['alert'])): ?>
    <div class="alert alert-<?= $data['alert']['type'] ?>"><?= $data['alert']['message'] ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <a href="/ecommerce/auth/register">Not registered? Register</a>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php  include("Views/includes/footer.php"); ?>