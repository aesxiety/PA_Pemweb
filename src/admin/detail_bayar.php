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

if (isset($_GET["id"])) {
    $id_pengecekan = $_GET["id"];
    $query = "SELECT * FROM transaksi WHERE id_pesanan = $id_pengecekan";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $data_transaksi = mysqli_fetch_assoc($result);
    } else {
        echo "<script>
        alert('Transaksi tidak ditemukan');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    }
    
} else {
    echo "<script>
    alert('Transaksi tidak ditemukan');
    document.location.href = 'konfirmasi_pesanan.php';
    </script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/konfirmasi_pesanan.css">
    <link rel="icon" href="../asset/logo.png">
    <script src="script/admin.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Landing Page</title>
</head>
<body>
    <nav class="nav-admin1">
        <div class="show-more" onclick="toggleSubMenu()"><i class="fa-solid fa-bars"></i></div>
        <div class="welcome-text">Selamat Datang</div>
        <div class="akun-admin" onclick="toggleSubAkun()"><i class="fa-solid fa-user-secret" style="color: #ffffff;"></i>
            <div class="sub-akun" id="sub-akun">
                <a href="../pages/UserPage.php">Home</a>
                <a href="index.php">Menu Admin</a>
                <a href="../util/logout.php">Log Out</a>
            </div>
        </div>
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
                    <a href="view_message.php">Lihat Pesan dari User</a>
                    <a href="#">Hapus Pesan</a>
                </div>
            </p>
        </div>
    </nav>
    <main>
        <div class="isi-page-admin">
            <h2>Transaction Details</h2>
            <table>
                <tr>
                    <th>ID Transaksi</th>
                    <th>ID Pesanan</th>
                    <th>ID Rekening</th>
                    <th>Rekening Tujuan</th>
                    <th>Total Pembayaran</th>
                    <th>Tanggal Transaksi</th>
                    <th>Bukti Pembayaran</th>
                </tr>
                <?php
                if (isset($data_transaksi) && !empty($data_transaksi)) {
                    echo "<tr>";
                    echo "<td>{$data_transaksi['id_transaksi']}</td>";
                    echo "<td>{$data_transaksi['id_pesanan']}</td>";
                    echo "<td>{$data_transaksi['id_rekening']}</td>";
                    echo "<td>{$data_transaksi['rekening_tujuan']}</td>";
                    echo "<td>{$data_transaksi['total_pembayaran']}</td>";
                    echo "<td>{$data_transaksi['tanggal_transaksi']}</td>";
                    echo "<td><img src='../bukti_transaksi/{$data_transaksi['bukti_pembayaran']}' alt='Bukti Pembayaran'></td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='7'>Transaction not found</td></tr>";
                }
                ?>
            </table>
            <button><a href="konfirmasi_pesanan.php">Konfirmasi Pesanan</a></button>
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
