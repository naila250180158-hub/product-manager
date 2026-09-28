<?php
require __DIR__ . '/../config/db.php';

$stmt = $pdo->query(
    "SELECT id, name, category, price, stock FROM products ORDER BY id DESC"
);
$products = $stmt->fetchAll();

$status = $_GET['status'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Daftar Produk</h2>

    <?php if ($status === 'created'): ?>
        <p style="color:green">Produk berhasil disimpan.</p>
    <?php elseif ($status === 'updated'): ?>
        <p style="color:green">Produk berhasil diperbarui.</p>
    <?php elseif ($status === 'deleted'): ?>
        <p style="color:green">Produk berhasil dihapus.</p>
    <?php endif; ?>

    <p><a href="create.php">+ Tambah Produk</a></p>

    <div class="products">
        <?php if (empty($products)): ?>
            <p>Belum ada produk.</p>
        <?php endif; ?>

        <?php foreach ($products as $p): ?>
            <div class="card">
                <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p>Kategori: <?= htmlspecialchars($p['category'], ENT_QUOTES, 'UTF-8') ?></p>
                <p>Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
                <p>Stok: <?= (int)$p['stock'] ?></p>
                <div class="actions">
                    <a href="edit.php?id=<?= $p['id'] ?>">Edit</a>
                    <form method="POST" action="delete.php" style="display:inline">
                        <input type="hidden" name="id" value="<?= $p['id'] ?>">
                        <button type="submit" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>