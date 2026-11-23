<?php
include_once("config.php");
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include("header.php");
?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <h2 class="mb-4">Shto produkt</h2>
          <?php if (!empty($_SESSION['product_error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['product_error']) ?></div>
            <?php unset($_SESSION['product_error']); ?>
          <?php endif; ?>
          <form action="add2.php" method="post">
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" name="title" maxlength="100" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" maxlength="100" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Quantity</label>
              <input type="number" class="form-control" name="quantity" min="0" step="1" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Price (€)</label>
              <input type="number" class="form-control" name="price" min="0" step="0.01" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
            <a href="dashboard2.php" class="btn btn-outline-secondary">Back</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
