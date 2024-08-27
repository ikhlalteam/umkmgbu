<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'ecomacare_db');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $whatsapp_number = $_POST['whatsapp_number'];

    
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "../images/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image', whatsapp_number='$whatsapp_number' WHERE id = $id";
    } else {
        $sql = "UPDATE products SET name='$name', description='$description', price='$price', whatsapp_number='$whatsapp_number' WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        textarea {
            resize: none;
            height: 100px;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
        .preview {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .preview .box {
            width: 48%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .preview img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .preview h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .preview p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>
    <form action="edit_product.php?id=<?= $product['id']; ?>" method="post" enctype="multipart/form-data" oninput="updatePreview()">
        <label for="name">Nama produk:</label>
        <input type="text" id="name" name="name" value="<?= $product['name']; ?>" required>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required><?= $product['description']; ?></textarea>

        <label for="price">Harga (RP):</label>
        <input type="number" id="price" name="price" value="<?= $product['price']; ?>" required>

        <label for="whatsapp_number">NO WhatsApp :</label>
        <input type="text" id="whatsapp_number" name="whatsapp_number" value="<?= $product['whatsapp_number']; ?>" required>

        <label for="image">Foto produk:</label>
        <input type="file" id="image" name="image" onchange="previewImage(event)">

        <button type="submit">Update Produk</button>
    </form>

    <div class="preview">
        <div class="box">
            <h3>Sebelum</h3>
            <img src="../images/<?= $product['image']; ?>" id="beforeImage" alt="<?= $product['name']; ?>">
            <p><strong>Nama:</strong> <?= $product['name']; ?></p>
            <p><strong>Deskripsi:</strong> <?= $product['description']; ?></p>
            <p><strong>Harga:</strong> RP <?= number_format($product['price'], 2); ?></p>
            <p><strong>WhatsApp:</strong> <?= $product['whatsapp_number']; ?></p>
        </div>
        <div class="box">
            <h3>Sesudah</h3>
            <img src="../images/<?= $product['image']; ?>" id="afterImage" alt="New Image">
            <p><strong>Nama:</strong> <span id="afterName"><?= $product['name']; ?></span></p>
            <p><strong>Deskripsi:</strong> <span id="afterDescription"><?= $product['description']; ?></span></p>
            <p><strong>Harga:</strong> RP <span id="afterPrice"><?= number_format($product['price'], 3); ?></span></p>
            <p><strong>WhatsApp:</strong> <span id="afterWhatsApp"><?= $product['whatsapp_number']; ?></span></p>
        </div>
    </div>
</div>

<script>
    function updatePreview() {
        document.getElementById('afterName').textContent = document.getElementById('name').value;
        document.getElementById('afterDescription').textContent = document.getElementById('description').value;
        document.getElementById('afterPrice').textContent = parseFloat(document.getElementById('price').value).toFixed(3);
        document.getElementById('afterWhatsApp').textContent = document.getElementById('whatsapp_number').value;
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('afterImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
