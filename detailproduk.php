<?php
$conn = new mysqli('localhost', 'root', '', 'ecomacare_db');

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Query to fetch the product details
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Detail Produk</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <link rel="stylesheet" href="stylle.css">
        </head>
        <body>
        <?php include 'navbar.php'; ?>
        <div class="product-detail">
            <div class="product-image">
                <img src="images/<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div class="product-info">
                <h1><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p><?= htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="price">Harga: RP <?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?></p>
                <a href="https://wa.me/<?= htmlspecialchars($product['whatsapp_number'], ENT_QUOTES, 'UTF-8'); ?>?text=saya mau pesan ini <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>" class="whatsapp-button">
                    <i class="fas fa-phone"></i> Pesan via WhatsApp
                </a>
            </div>
        </div>
        </body>
        <?php include 'footer.php'; ?>
        </html>
        <?php
    } else {
        echo "Product not found.";
    }

    $stmt->close();
} else {
    echo "No product ID provided.";
}

$conn->close();
?>
