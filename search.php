<?php

$conn = new mysqli('localhost', 'root', '', 'ecomacare_db');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM products";
$result = $conn->query($sql);


if ($result && $result->num_rows > 0) 


if (isset($_GET['query'])) {
    $searchQuery = $conn->real_escape_string($_GET['query']);
    $sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Hasil Pencarian untuk: " . htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8') . "</h2>";
        echo "<div class='product-container'>";
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-card'>";
            $imagePath = "images/" . $row['image'];
            if (file_exists($imagePath)) {
                echo "<a href='detailproduk.php?id=" . $row['id'] . "'><img src='" . $imagePath . "' alt='" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "'></a>";
            } else {
                echo "<p style='color:red;'>Image not found.</p>";
            }
            echo "<h3>" . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "</h3>";
            echo "<p>" . htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p class='price'>Harga: RP " . htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<a href='https://wa.me/" . htmlspecialchars($row['whatsapp_number'], ENT_QUOTES, 'UTF-8') . "?text=saya mau pesan ini " . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . "' class='whatsapp-button'><i class='fas fa-phone'></i> Pesan via WhatsApp</a>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>Tidak ada produk ditemukan.</p>";
    }
} else {
    echo "<p>Masukkan kata kunci untuk pencarian.</p>";
}

$conn->close();
?>
