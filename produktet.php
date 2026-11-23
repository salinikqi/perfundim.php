<?php
// Struktura e tabeles se produkteve. Mund te perfshihet ne faqet e produkteve.
try {
    $pdo = $connect;
    $pdo->exec("CREATE TABLE IF NOT EXISTS produktet (
        id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        description VARCHAR(100) NOT NULL,
        quantity INT(100) NOT NULL DEFAULT 0,
        price DECIMAL(10,2) NOT NULL DEFAULT 0.00
    )");

    // Nese tabela ekziston nga versioni i vjeter, shtohen vetem kolonat qe mungojne.
    $columns = $pdo->query("SHOW COLUMNS FROM produktet")->fetchAll(PDO::FETCH_COLUMN);
    if (!in_array('quantity', $columns, true)) {
        $pdo->exec("ALTER TABLE produktet ADD quantity INT(100) NOT NULL DEFAULT 0");
    }
    if (!in_array('price', $columns, true)) {
        $pdo->exec("ALTER TABLE produktet ADD price DECIMAL(10,2) NOT NULL DEFAULT 0.00");
    }
    // Rrit gjatesine e fushave ekzistuese pa i fshire te dhenat.
    $pdo->exec("ALTER TABLE produktet MODIFY title VARCHAR(100) NOT NULL, MODIFY description VARCHAR(100) NOT NULL");
} catch (PDOException $e) {
    die("Gabim me tabelen produktet: " . htmlspecialchars($e->getMessage()));
}
?>