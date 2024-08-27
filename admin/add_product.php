<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'ecomacare_db');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $whatsapp_number = $_POST['whatsapp_number'];
    
    
    $image = $_FILES['image']['name'];
    $target = "../images/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO products (name, description, price, image, whatsapp_number) 
            VALUES ('$name', '$description', '$price', '$image', '$whatsapp_number')";
    $conn->query($sql);
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .preview img {
            max-width: 150px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .preview h3 {
            margin: 10px 0 5px;
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
    <h2>Tambahkan produk baru</h2>
    <form action="add_product.php" method="post" enctype="multipart/form-data" oninput="updatePreview()">
        <label for="name">Nama Produk:</label>
        <input type="text" id="name" name="name" placeholder="Product Name" required>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" placeholder="Product Description" required></textarea>

        <label for="price">Harga (RP):</label>
        <input type="number" id="price" name="price" placeholder="Product Price" required>

        <label for="whatsapp_number">NO WhatsApp :</label>
        <input type="text" id="whatsapp_number" name="whatsapp_number" placeholder="WhatsApp Number" required>

        <label for="image">Foto produk:</label>
        <input type="file" id="image" name="image" onchange="previewImage(event)" required>

        <button type="submit">Tambah Produk</button>
    </form>

    <div class="preview">
        <h3>Produk Preview</h3>
        <img src="" id="imagePreview" alt="Image Preview" style="display:none;">
        <p><strong>Nama:</strong> <span id="namePreview"></span></p>
        <p><strong>Deskripsi:</strong> <span id="descriptionPreview"></span></p>
        <p><strong>Harga:</strong> RP <span id="pricePreview"></span></p>
        <p><strong>WhatsApp:</strong> <span id="whatsappPreview"></span></p>
    </div>
</div>

<script>
    function updatePreview() {
        document.getElementById('namePreview').textContent = document.getElementById('name').value;
        document.getElementById('descriptionPreview').textContent = document.getElementById('description').value;
        document.getElementById('pricePreview').textContent = parseFloat(document.getElementById('price').value).toFixed(3);
        document.getElementById('whatsappPreview').textContent = document.getElementById('whatsapp_number').value;
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
