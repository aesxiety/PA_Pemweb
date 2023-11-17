<?php
require "../util/loginSession.php";
require "../util/katalog.php";
require "../util/koneksi.php";

if ($userType !== 'admin') {
    echo "<script>
        alert('kamu itu bukan admin');
        document.location.href = '../index.php';
    </script>";
}

// Query to fetch all products from the 'sepatu' table
$sql = "SELECT * FROM sepatu";
// Execute the query using your database connection (assuming you have one)
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin_page.css">
    <script src="script/admin.js"></script>
    <link rel="icon" href="../asset/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Landing Page</title>
</head>

<nav class="nav-admin">
        <div class="show-more" onclick="toggleSubMenu()"><i class="fa-solid fa-bars"></i></div>
        <div class="welcome-text">Selamat Datang <?= $username ?></div>
            <div class="submenu" id="submenu">
                <a href="../pages/UserPage.php">Home</a>
                <a href="index.php">Menu Admin</a>
                <p>
                    <a href="manajemen_katalog.php">Manajemen Katalog</a>
                </p>
                <a href="konfirmasi_pesanan.php">Konfirmasi Pesanan</a>
                <p>
                    <a href="javascript:void(0);" onclick="toggleDropdown('dropdown3')">Lihat Kontak</a>
                    <div class="dropdown" id="dropdown3">
                        <a href="#">Lihat Pesan dari User</a>
                        <a href="#">Hapus Pesan</a>
                    </div>
                </p>
                <a href="../util/logout.php">Log Out</a>
        </div>
    </nav>  

<body>
    <main>
        <div class="isi-page-admin">
        <a href="tambah.php" class="tambah">Tambah Produk</a>
        <table class="tabel">
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
            // Loop through the query results and display each product
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_sepatu'] . "</td>";
                echo "<td>" . $row['nama_sepatu'] . "</td>";
                echo "<td>" . $row['jenis_sepatu'] . "</td>";
                echo "<td>" . $row['harga'] . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td><img src='../img/" . $row['sepatu_img'] . "' alt='Product Image' width='100'></td>";
                echo "<td><a href='edit_product.php?id=" . $row['id_sepatu'] . "'>Edit</a> | <a href='../util/delete_product.php?id=" . $row['id_sepatu'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        </div>
    </main>
    <footer>
        <div class="footer" id="setting">
            <div class="icon">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footern">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Setting</a></li>
                    <li><a href="#">About Me</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footerb">
            <img src="../asset/logo.png" alt="" style="width: 50px; height: 50px;">
                <p>Copyright 2023,Designed By Kelompok PA</p>
            </div>
        </div>
        </footer>

</body>
</html>
