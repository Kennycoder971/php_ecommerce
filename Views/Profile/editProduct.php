<?php include_once("Views/includes/header.php");?>

<?php include_once("Views/includes/nav.php");?>

<div class="container-fluid"">
<div class=" row">

    <?php include("Views/Profile/sidebar.php");?>

    <main class=" col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2> Edit Product</h2>
        <?php if(isset($data['alert'])): ?>
        <div class="alert alert-<?= $data['alert']['type'] ?>"><?= $data['alert']['message'] ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title"
                    value="<?= isset($data['product']['title'])  ? $data['product']['title'] : '' ?>" name="title"
                    required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    required><?= isset($data['product']['description'])  ? $data['product']['description'] : '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock"
                    value="<?= isset($data['product']['stock'])  ? $data['product']['stock'] : '' ?>" name="stock"
                    required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price"
                    value="<?= isset($data['product']['price'])  ? $data['product']['price'] : '' ?>" step="0.01"
                    required>
            </div>
            <!-- Images section -->
            <div class="mb-3">
                <h4>Product Image</h4>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- PHP loop to fetch and display images -->
                    <div class="col">
                        <div class="card">
                            <img src="<?= productImage($data['product']) ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <a href="<?= base_url() ?>profile/deleteProduct/<?= $data['product']['id'] ?>"
                                    class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat the above card structure for each image -->
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </main>
</div>
</div>

<script>
function showDeleteConfirmation(id) {
    if (confirm("Are you sure you want to delete this image?")) {
        location.assign(`<?=base_url()?>profile/deleteProduct/id=${id}`);
    }
}
</script>
<?php  include_once("Views/includes/footer.php"); ?>