<?php
include_once("config.php");
include_once("produktet.php");

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    header("Location: dashboard2.php");
    exit;
}

$stmt = $connect->prepare("SELECT * FROM produktet WHERE id = :id");
$stmt->execute([':id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    $_SESSION['product_message'] = "Produkti nuk u gjet.";
    header("Location: dashboard2.php");
    exit;
}

include("header.php");
?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <h2 class="mb-4">Update Product #<?= (int)$id ?></h2>
          <form action="uptade2.php" method="post">
            <input type="hidden" name="id" value="<?= (int)$product['id'] ?>">
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input class="form-control" type="text" name="title" maxlength="100" value="<?= htmlspecialchars($product['title']) ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" maxlength="100" rows="3" required><?= htmlspecialchars($product['description']) ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Quantity</label>
              <input class="form-control" type="number" name="quantity" min="0" step="1" value="<?= (int)$product['quantity'] ?>" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Price (€)</label>
              <input class="form-control" type="number" name="price" min="0" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Ruaj ndryshimet</button>
            <a href="dashboard2.php" class="btn btn-outline-secondary">Anulo</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
