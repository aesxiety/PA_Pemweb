<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

$id_akun = $id_akun; // Adjust how you retrieve id_akun from loginSession

$query_select_rekening = "SELECT * FROM rekening_user WHERE id_pelanggan = $id_akun";
$result_select_rekening = mysqli_query($conn, $query_select_rekening);

$nama_bank = "";
$no_rekening = "";
$nama_rekening = "";

if(mysqli_num_rows($result_select_rekening) > 0) {
    $row_rekening = mysqli_fetch_assoc($result_select_rekening);
    $nama_bank = $row_rekening['nama_bank'];
    $no_rekening = $row_rekening['no_rekening'];
    $nama_rekening = $row_rekening['nama_rekening'];
}
?>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="path-to-your-fontawesome/css/all.css"> <!-- Ganti path dengan path sesuai tempat penyimpanan font-awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav {
            background-color:  #7720FE;
            color: #fff;
            padding: 10px;
            text-align: right;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }

        header {
            display: flex;
        }

        aside {
            width: 0p15x;
            height: 100%;
            background-color: #7750FE;
            color: #fff;
            padding: 19px;
            box-sizing: border-box;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        footer {
            background-color: #7720FE;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: auto;
        }

        .icon a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .footer ul li {
            margin: 0 10px;
        }
        
        /* style untuk didalam main */
        .detail-pesanan {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-bottom: 10px;
        }

        .img-detail-pesanan img {
            margin-right: 10px; 
        }
    </style>
</head>
<body>
    <nav>
        <a href="UserPage.php">kembali</a>    
        <a href="../util/logout.php">Logout</a>
    </nav>
    <header>
        <aside>
            <ul>
                <li><a href="#" class="menu-link">Manajemen Akun</a></li>
                <li><a href="#" class="menu-item">Informasi Rekening</a></li>
                <li><a href="pesanan.php" class="menu-item">Pesanan</li>
                <li><a href="#" class="menu-item">Chat </li>
                <li></li>
            </ul>
        </aside>

        <main>
            <title>Informasi Rekening</title>
            <a href="akun.php">kembali</a>
            <h2>Informasi Rekening</h2>

            <?php if(empty($nama_bank) || empty($no_rekening) || empty($nama_rekening)) : ?>
                <p>Anda belum menyimpan informasi rekening.</p>
                <a href="tambah_rekening.php">buat rekening</a>
            <?php else : ?>
                <p>Anda memiliki rekening dengan detail sebagai berikut:</p>
                <p>Nama Bank: <?= $nama_bank; ?></p>
                <p>Nomor Rekening: <?= $no_rekening; ?></p>
                <p>Nama Pemilik Rekening: <?= $nama_rekening; ?></p>
                <p><a href="edit_rekening.php">Edit Informasi Rekening</a></p>
            <?php endif; ?>
        </main>
    </header>
    <footer class="footer" id="setting">
        <div class="icon">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
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
            <p>Copyright 2023, Designed By Kelompok PA</p>
        </div>
    </footer>
</body>
</html>
