<?php
require_once 'Database.php';

$db = Database::getInstance()->getConnection();

try {
    $sql = "
        SELECT 
            u.name AS customer_name,
            u.email,
            SUM(o.total_amount) AS total_spent,
            COUNT(o.id) AS order_count
        FROM users u
        JOIN orders o ON u.id = o.user_id
        GROUP BY u.id
        ORDER BY total_spent DESC
        LIMIT 3
    ";

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $customers = $stmt->fetchAll();

} catch (PDOException $e) {
    die("Query Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Top 3 Customers</title>
</head>
<body>

<h2>🏆 Top 3 Khách Hàng Chi Tiêu Cao Nhất</h2>

<?php if (empty($customers)): ?>
    <p>Không có dữ liệu.</p>
<?php else: ?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Hạng</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Tổng chi tiêu</th>
        <th>Số đơn</th>
    </tr>

    <?php foreach ($customers as $index => $c): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($c['customer_name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= number_format($c['total_spent'], 0, ',', '.') ?> đ</td>
            <td><?= $c['order_count'] ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>

</body>
</html>