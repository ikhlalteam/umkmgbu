<?php

$conn = new mysqli('localhost', 'root', '', 'ecomacare_db');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM products";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="stylee.css">
   
    
   
    <title>Produk</title>
</head>
<body>
<?php include 'navbar.php'; ?>

    <div class="product-container">
    <?php while($row = $result->fetch_assoc()): ?>
    <div class="product-card">
        <a href="detailproduk.php?id=<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="product-image-link">
            <?php 
            // Ambil path gambar dari database
            $imagePath = __DIR__ . "/images/" . $row['image'];
            
            if (file_exists($imagePath)) {
                echo "<img src='images/" . $row['image'] . "' alt='" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "'>";
            } else {
                echo "<p style='color:red;'>Image not found.</p>";
            }
            ?>
        </a>
        <h3><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
        <p><?= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="price">Harga: RP <?= htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8'); ?></p>
        <a href="https://wa.me/<?= htmlspecialchars($row['whatsapp_number'], ENT_QUOTES, 'UTF-8'); ?>?text=saya mau pesan ini <?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>" class="whatsapp-button">
            <i class="fas fa-phone"></i> Pesan via WhatsApp
        </a>
    </div>
    <?php endwhile; ?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>