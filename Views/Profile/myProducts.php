<?php  

function productImage($product) {
    $img = isset($product['imgUrl']) ? base_url(). $product['imgUrl'] : assets().'images/noImage.jpeg';
    return $img;
}
?>

<?php include_once("Views/includes/header.php");?>

<?php include_once("Views/includes/nav.php");?>

<div class="container-fluid"">
<div class=" row">

    <?php include("Views/Profile/sidebar.php");?>

    <main class=" col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container mt-5">
            <h2>Product Management</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <!-- PHP loop to fetch and display products in cards -->

                <?php foreach($data['products'] as $product): ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= productImage($product) ?>" class="card-img-top" alt="<?= $product['title'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['title'] ?></h5>
                            <p class="card-text"><?= CURRENCY.$product['price'] ?></p>
                            <a href="<?= base_url() ?>profile/editProduct/<?=$product['id'] ?>"
                                class="btn btn-primary">Edit</a>
                            <a href="<?= base_url() ?>profile/deleteProduct/<?=$product['id'] ?>"
                                class="btn btn-success">Update</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Repeat the above card structure for each product -->
            </div>
        </div>

    </main>
</div>
</div>

<?php  include_once("Views/includes/footer.php"); ?>