<?php 
$user = getUserSession();

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container-fluid ">
        <img src="<?= base_url() ?>assets/images/logo.png" alt="Logo" style="width:70px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0  d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>

                <?php if(empty($user)): ?>
                <a href="<?= base_url() ?>/auth/login" class='btn-primary btn'>Log in</a>
                <?php else: ?>

                <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?= isset($user['username']) ? $user['username'] : 'user' ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="<?= base_url() ?>/profile/index">My profile</a></li>
                        <li><a class="dropdown-item" href="#">My orders</a></li>

                        <?php if($user['isSeller']): ?>
                        <li><a class="dropdown-item" href="#">My sales</a></li>
                        <li><a class="dropdown-item" href="#">My products</a></li>
                        <?php endif; ?>

                        <li><a class="dropdown-item bg-warning" href="<?= base_url() ?>auth/logout">Log out</a></li>
                    </ul>

                    <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>