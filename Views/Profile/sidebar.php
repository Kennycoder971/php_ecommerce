<?php 

    $user = getUserSession();

?>
<nav id=" sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar mb-3">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>profile/index">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>profile/security">Security</a>
            </li>

            <?php if($user['isSeller']): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>profile/addProducts">Add product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>profile/myProducts">My products</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>