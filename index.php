<?php

$conn = new mysqli('localhost', 'root', '', 'ecomacare_db');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM products";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ecomacare Catalog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
   
</head>

<body>
<?php include 'navbar.php'; ?>
<div class="banner-slider">
        <div class="banner-slide"><img src="images/7.jpg" alt="Banner 1"></div>
        <div class="banner-slide"><img src="images/8.jpg" alt="Banner 2"></div>
        <div class="banner-slide"><img src="images/3.jpg" alt="Banner 3"></div>
        <div class="banner-slide"><img src="https://th.bing.com/th/id/OIP.hndBzjtukoO_YS4txHrzUQHaCe?w=294&h=116&c=7&r=0&o=5&pid=1.7" alt="Banner 4"></div>
    </div>

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
</body>
<?php include 'footer.php'; ?>
<script>
    let currentSlide = 0;
const slides = document.querySelectorAll('.banner-slide');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.style.display = i === index ? 'block' : 'none';
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

setInterval(nextSlide, 3000); // Change slide every 3 seconds


</script>
</html>

<?php
} else {
    echo "No products found or query failed.";
}
$conn->close();
?>
