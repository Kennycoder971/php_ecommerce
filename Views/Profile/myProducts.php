<?php include_once("Views/includes/header.php");?>

<?php include_once("Views/includes/nav.php");?>

<div class="container-fluid"">
<div class=" row">

    <?php include("Views/Profile/sidebar.php");?>

    <main class=" col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container mt-5">
            <h2>Product Management</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- PHP loop to fetch and display products in cards -->
                <div class="col">
                    <div class="card">
                        <img src="product_image.jpg" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title">Product Title</h5>
                            <p class="card-text">$99.99</p>
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-success">Update</button>
                        </div>
                    </div>
                </div>
                <!-- Repeat the above card structure for each product -->
            </div>
        </div>

    </main>
</div>
</div>

<?php  include_once("Views/includes/footer.php"); ?>