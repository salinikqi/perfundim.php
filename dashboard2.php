<?php
include_once('config.php');
include_once('produktet.php');

if (empty($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$getProduktet = $connect->prepare("SELECT * FROM produktet ORDER BY id DESC");
$getProduktet->execute();
$produktet = $getProduktet->fetchAll();

include("header.php");
?>
<nav class="navbar navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard2.php">Welcome, <i><?= htmlspecialchars($_SESSION['username']) ?></i></a>
    <a class="nav-link text-white" href="logout.php">Sign out</a>
  </div>
</nav>

<div class="container py-4">
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
      <h1 class="h2 mb-1">Products Dashboard</h1>
      <p class="text-muted mb-0">Menaxho produktet: shto, ndrysho ose fshij.</p>
    </div>
    <a href="signup2.php" class="btn btn-primary">+ Add Product</a>
  </div>

  <?php if (!empty($_SESSION['product_message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($_SESSION['product_message']) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['product_message']); ?>
  <?php endif; ?>

  <div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
      <strong>Lista e produkteve</strong>
      <span class="badge bg-primary ms-2"><?= count($produktet) ?> produkte</span>
    </div>
    <div class="table-responsive">
      <table class="table table-hover table-striped align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Veprimet</th>
          </tr>
        </thead>
        <tbody>
        <?php if (empty($produktet)): ?>
          <tr><td colspan="6" class="text-center text-muted py-4">Nuk ka ende produkte.</td></tr>
        <?php else: foreach ($produktet as $product): ?>
          <tr>
            <td><?= (int)$product['id'] ?></td>
            <td><?= htmlspecialchars($product['title']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= (int)$product['quantity'] ?></td>
            <td><?= number_format((float)$product['price'], 2) ?> €</td>
            <td class="text-nowrap">
              <a class="btn btn-sm btn-outline-primary" href="edit2.php?id=<?= (int)$product['id'] ?>">Update</a>
              <form action="delete2.php" method="post" class="d-inline" onsubmit="return confirm('A je i sigurt qe deshiron ta fshish produktin?');">
                <input type="hidden" name="id" value="<?= (int)$product['id'] ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
