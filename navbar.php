<style>
    /* Navbar */
.navbar {
    background: linear-gradient(135deg, #333, #555);
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    position: relative;
}

.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.navbar ul li {
    margin: 0 15px;
}

.navbar ul li a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 8px 15px;
    transition: color 0.3s ease, background-color 0.3s ease;
    border-radius: 5px;
}

.navbar ul li a:hover {
    color: #fff;
    background-color: rgba(255, 255, 255, 0.2);
}

/* Mobile Menu Styles */
.navbar .menu-toggle {
    display: none;
    font-size: 24px;
    color: white;
    background: none;
    border: none;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 10px;
}

.navbar .menu-toggle i {
    margin: 0;
}

@media (max-width: 768px) {
    .navbar ul {
        display: none;
        flex-direction: column;
        width: 100%;
        background: linear-gradient(135deg, #333, #555);
        position: absolute;
        top: 50px;
        left: 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .navbar ul.show {
        display: flex;
    }

    .navbar ul li {
        margin: 10px 0;
    }

    .navbar .menu-toggle {
        display: block;
    }
}

/* Search Form */
.search-form {
    display: flex;
    align-items: center;
    margin-left: auto;
    margin-right: 15px;
}

.search-form input[type="text"] {
    padding: 5px 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
    outline: none;
    width: 200px;
    transition: width 0.4s ease-in-out;
}

.search-form input[type="text"]:focus {
    width: 250px;
}

.search-form button {
    padding: 5px 10px;
    font-size: 16px;
    border: none;
    background-color: #555;
    color: white;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-form button:hover {
    background-color: #333;
}

.search-form button i {
    margin: 0;
}

</style>
<div class="navbar">
    <button class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="produk.php">Produk</a></li>
    </ul>
    <form action="search.php" method="GET" class="search-form">
        <input type="text" name="query" placeholder="Cari Produk..." required>
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>
