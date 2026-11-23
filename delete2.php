<?php
include_once("config.php");
include_once("produktet.php");

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    if ($id && $id > 0) {
        $stmt = $connect->prepare("DELETE FROM produktet WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $_SESSION['product_message'] = $stmt->rowCount()
            ? "Produkti u fshi me sukses."
            : "Produkti nuk u gjet.";
    }
}
header("Location: dashboard2.php");
exit;
?>