<?php
require_once __DIR__ . '/../Path3/Database.php';

$db = Database::getInstance()->getConnection();

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$sql = "
    SELECT 
        p.id,
        p.name,
        p.price,
        p.stock,
        c.category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE 1=1
";

$params = [];

if (!empty($search)) {
    $sql .= " AND p.name LIKE :search";
    $params[':search'] = "%$search%";
}

if (!empty($category)) {
    $sql .= " AND p.category_id = :category";
    $params[':category'] = $category;
}

$stmt = $db->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

$categories = $db->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Product Dashboard</title>

<style>
body {
    font-family: 'Segoe UI', Arial;
    background: #0f172a;
    color: #e2e8f0;
    padding: 30px;
}

h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #f8fafc;
}

form {
    text-align: center;
    margin-bottom: 25px;
}

input, select {
    padding: 10px;
    margin: 5px;
    border-radius: 8px;
    border: none;
    background: #1e293b;
    color: white;
}

button {
    padding: 10px 15px;
    border-radius: 8px;
    border: none;
    background: linear-gradient(135deg, #3b82f6, #9333ea);
    color: white;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    opacity: 0.9;
}

table {
    border-collapse: collapse;
    width: 100%;
    background: #1e293b;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.5);
}

th {
    background: linear-gradient(135deg, #3b82f6, #9333ea);
    padding: 14px;
    font-size: 13px;
}

td {
    padding: 14px;
    border-bottom: 1px solid #334155;
}

tr:hover {
    background: #334155;
}

.low-stock {
    background: rgba(239, 68, 68, 0.2) !important;
}

.stock-badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: bold;
}

.stock-ok {
    background: #22c55e;
    color: white;
}

.stock-low {
    background: #ef4444;
    color: white;
}
</style>

</head>
<body>

<h2>📊 Product Admin Dashboard</h2>

<form method="GET">
    <input type="text" name="search" placeholder="🔍 Tìm sản phẩm..." value="<?= htmlspecialchars($search) ?>">

    <select name="category">
        <option value="">-- All Categories --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= ($category == $cat['id']) ? 'selected' : '' ?>>
                <?= $cat['category_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Filter</button>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Product</th>
    <th>Price</th>
    <th>Category</th>
    <th>Stock</th>
</tr>

<?php foreach ($products as $p): ?>
<tr class="<?= ($p['stock'] < 10) ? 'low-stock' : '' ?>">
    <td><?= $p['id'] ?></td>
    <td><?= htmlspecialchars($p['name']) ?></td>
    <td><?= number_format($p['price'], 0, ',', '.') ?> đ</td>
    <td><?= $p['category_name'] ?? 'N/A' ?></td>
    <td>
        <span class="stock-badge <?= ($p['stock'] < 10) ? 'stock-low' : 'stock-ok' ?>">
            <?= $p['stock'] ?>
        </span>
    </td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>