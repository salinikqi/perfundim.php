<?php
include_once("config.php");
include_once("produktet.php");

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $quantity = $_POST['quantity'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($title === '' || $description === '' ||
        filter_var($quantity, FILTER_VALIDATE_INT) === false || (int)$quantity < 0 ||
        !is_numeric($price) || (float)$price < 0) {
        $_SESSION['product_error'] = "Ploteso te gjitha fushat me vlera valide.";
        header("Location: signup2.php");
        exit;
    }

    $sql = "INSERT INTO produktet (title, description, quantity, price)
            VALUES (:title, :description, :quantity, :price)";
    $sqlQuery = $connect->prepare($sql);
    $sqlQuery->execute([
        ':title' => $title,
        ':description' => $description,
        ':quantity' => (int)$quantity,
        ':price' => $price
    ]);

    $_SESSION['product_message'] = "Produkti u shtua me sukses.";
    header("Location: dashboard2.php");
    exit;
}

header("Location: signup2.php");
exit;
?>