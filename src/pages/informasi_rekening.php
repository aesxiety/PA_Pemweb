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
    <link rel="icon" href="../asset/logo.png">
    <link rel="stylesheet" href="path-to-your-fontawesome/css/all.css"> <!-- Ganti path dengan path sesuai tempat penyimpanan font-awesome -->
    <link rel="stylesheet" href="../style/info_rekening.css">
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
                <li><a href="TG_CONTACT.php" class="menu-item">Chat </li>
                <li></li>
            </ul>
        </aside>

        <main>
            <title>Informasi Rekening</title>
            <a href="UserPage.php">kembali</a>
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
