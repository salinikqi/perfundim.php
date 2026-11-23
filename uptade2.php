<?php
include_once("config.php");
include_once("produktet.php");

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['update'])) {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $quantity = $_POST['quantity'] ?? '';
    $price = $_POST['price'] ?? '';

    if (!$id || $id < 1 || $title === '' || $description === '' ||
        filter_var($quantity, FILTER_VALIDATE_INT) === false || (int)$quantity < 0 ||
        !is_numeric($price) || (float)$price < 0) {
        $_SESSION['product_message'] = "Te dhenat nuk jane valide.";
        header("Location: dashboard2.php");
        exit;
    }

    $sql = "UPDATE produktet SET title=:title, description=:description,
            quantity=:quantity, price=:price WHERE id=:id";
    $prep = $connect->prepare($sql);
    $prep->execute([
        ':id' => $id,
        ':title' => $title,
        ':description' => $description,
        ':quantity' => (int)$quantity,
        ':price' => $price
    ]);

    $_SESSION['product_message'] = "Produkti u perditesua me sukses.";
}
header("Location: dashboard2.php");
exit;
?>