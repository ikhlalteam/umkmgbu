<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'ecomacare_db');
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #4CAF50;
        padding: 10px 0;
        color: white;
        text-align: center;
    }
    .container {
        width: 80%;
        margin: 30px auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        margin-top: 0;
    }
    a {
        text-decoration: none;
        color: #4CAF50;
    }
    a:hover {
        text-decoration: underline;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    img {
        border-radius: 5px;
    }
    .actions a {
        margin: 0 5px;
        padding: 5px 10px;
        color: white;
        border-radius: 3px;
    }
    .actions a.edit {
        background-color: #007bff;
    }
    .actions a.edit:hover {
        background-color: #0069d9;
    }
    .actions a.delete {
        background-color: #dc3545;
    }
    .actions a.delete:hover {
        background-color: #c82333;
    }
    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .btn:hover {
        background-color: #45a049;
    }
</style>

</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
</header>

<div class="container">
    <h2>Management Products</h2>
    <a href="add_product.php" class="btn">Tambahkan produk</a>
    <a href="logout.php" class="btn" style="float: right;">Logout</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>WhatsApp</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['description']; ?></td>
            <td>RP<?= number_format($row['price'], 3); ?></td>
            <td><img src="../images/<?= $row['image']; ?>" width="50"></td>
            <td><?= $row['whatsapp_number']; ?></td>
            <td class="actions">
    <a href="edit_product.php?id=<?= $row['id']; ?>" class="edit">Edit</a>
    <a href="delete_product.php?id=<?= $row['id']; ?>" class="delete" onclick="return confirm('Are you sure?')">Delete</a>
       </td>

        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
