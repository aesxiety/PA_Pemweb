<?php
require "../util/loginSession.php";
require "../util/koneksi.php";
require "../util/katalog.php";

if ($userType !== 'admin') {
    echo "<script>
        alert('kamu itu bukan admin');
        document.location.href = '../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin_page.css">
    <link rel="icon" href="../asset/logo.png">
    <script src="script/admin.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Landing Page</title>
</head>
<body>
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
                        <a href="admin_message.php">Lihat Pesan dari User</a>
                        <a href="#">Hapus Pesan</a>
                    </div>
                </p>
                <a href="../util/logout.php">Log Out</a>
        </div>
    </nav>  
    <div class="isi-page-admin">
    <img src="../img/ngawi running man-2023-11-12.png" alt="">
    </div>
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

<!-- <body>
    <nav class="nav-admin">
        <div class="show-more" onclick="toggleSubMenu()"><i class="fa-solid fa-bars"></i></div>
        <a href="index.php" class="home">Home</a>
        <div class="welcome-text">Selamat Datang</div>
        <div class="submenu" id="submenu">
            <p>
                <a href="manajemen_katalog.php">Manajemen Katalog</a>
            </p>
            <p>
                <a href="javascript:void(0);" onclick="toggleDropdown('dropdown2')">Manajemen Pesanan</a>
                <div class="dropdown" id="dropdown2">
                    <a href="konfirmasi_pesanan.php">Konfirmasi Pesanan</a>
                    <a href="#">Selesaikan Pesanan</a>
                    <a href="#">Lihat Detail Pesanan</a>
                </div>
            </p>
            <p>
                <a href="javascript:void(0);" onclick="toggleDropdown('dropdown3')">Lihat Kontak</a>
                <div class="dropdown" id="dropdown3">
                    <a href="#">Lihat Pesan dari User</a>
                    <a href="#">Hapus Pesan</a>
                </div>
            </p>
        </div>
    </nav>  
    <div class="isi-page-admin">
    <h1>Ini Isi</h1>
    <h1>Ini Admin</h1>
    </div>
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

</body> -->

</html>
