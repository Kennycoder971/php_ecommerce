<?php  include("Views/includes/header.php");?>

<body>
    <?php if(isset($_GET['msg']) && $_GET['msg'] === 'registered'): ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have been registered successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <?php endif; ?>


    <?php  include("Views/includes/nav.php");?>

    <main class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="<?= assets() ?>/images/logo.png" alt="" width="150" height="150">
        <h1 class="display-5 fw-bold">Centered hero</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s
                most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system,
                extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="<?= base_url() ?>/catalog" class="btn btn-primary btn-lg px-4 gap-3">Catalog</a>
                <a href="" class="btn btn-outline-secondary btn-lg px-4">Random product</a>
            </div>
        </div>
    </main>
    <section class="container ">
        <h2>Featured Products</h2>
        <div>
            <!-- Product cards -->
            <?php if(isset($data['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?= $data['error'] ?>
            </div>
            <?php elseif(empty($data['weeklyProducts'])): ?>

            <div class="alert alert-danger" role="alert">
                No products found
            </div>
            <?php else: ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <?php foreach($data['weeklyProducts'] as $product): ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= productImage($product) ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['title'] ?></h5>
                            <p class="card-text"><?= CURRENCY.$product['price'] ?></p>
                            <a href="<?= base_url() ?>profile/editProduct/<?=$product['id'] ?>"
                                class="btn btn-primary">Edit</a>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <!-- Repeat the above card structure for each product -->
        </div>
    </section>
    <?php   include("Views/includes/footer.php"); ?>