<?php
require __DIR__ . '/../config/db.php';

$errors = [];
$name = '';
$category = '';
$price = '';
$stock = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

    if (mb_strlen($name) < 3) {
        $errors['name'] = 'Nama minimal 3 karakter.';
    }
    if ($price === false || $price <= 0) {
        $errors['price'] = 'Harga harus lebih dari 0.';
    }
    if ($stock === false || $stock < 0) {
        $errors['stock'] = 'Stok tidak boleh negatif.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            "INSERT INTO products (name, category, price, stock) VALUES (:name, :category, :price, :stock)"
        );
        $stmt->execute([
            'name' => $name,
            'category' => $category ?: 'Umum',
            'price' => $price,
            'stock' => $stock
        ]);
        header("Location: index.php?status=created");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
</head>
<body>
    <h2>Tambah Produk</h2>
    <form method="POST" action="create.php">
        <label for="name">Nama Produk</label><br>
        <input id="name" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" required minlength="3"><br>
        <?php if (isset($errors['name'])): ?>
            <span style="color:red"><?= $errors['name'] ?></span><br>
        <?php endif; ?>

        <label for="category">Kategori</label><br>
        <input id="category" name="category" value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>"><br>

        <label for="price">Harga</label><br>
        <input id="price" name="price" type="number" min="1" value="<?= htmlspecialchars((string)$price, ENT_QUOTES, 'UTF-8') ?>" required><br>
        <?php if (isset($errors['price'])): ?>
            <span style="color:red"><?= $errors['price'] ?></span><br>
        <?php endif; ?>

        <label for="stock">Stok</label><br>
        <input id="stock" name="stock" type="number" min="0" value="<?= htmlspecialchars((string)$stock, ENT_QUOTES, 'UTF-8') ?>" required><br>
        <?php if (isset($errors['stock'])): ?>
            <span style="color:red"><?= $errors['stock'] ?></span><br>
        <?php endif; ?>

        <button type="submit">Simpan Produk</button>
    </form>
</body>
</html>