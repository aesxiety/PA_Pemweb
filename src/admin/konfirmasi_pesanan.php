<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

if ($userType !== 'admin') {
    echo "<script>
        alert('kamu itu bukan admin');
        document.location.href = '../index.php';
    </script>";
}

$result_query = mysqli_query($conn, "SELECT * FROM pesanan WHERE status_pesanan  != 'keranjang'");
$array_konfirmasi = [];

while ($row = mysqli_fetch_assoc($result_query)) {
    $array_konfirmasi[] = $row;
}

if (isset($_POST['status-dibatalkan'])) {
    $id_pesanan = $_POST['id-pengecekan'];
    $query = "UPDATE pesanan SET status_pesanan='dibatalkan' WHERE id_pesanan = $id_pesanan";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>
        alert('Status Berhasil Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    } else {
        echo "<script>
        alert('Status Gagal Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    }
}

if (isset($_POST['status-diproses'])) {
    $id_pesanan = $_POST['id-pengecekan'];
    $query = "UPDATE pesanan SET status_pesanan = 'diproses' WHERE id_pesanan = $id_pesanan ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>
        alert('Status Berhasil Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    } else {
        echo "<script>
        alert('Status Gagal Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    }
}
if (isset($_POST['status-dikirim'])) {
    $id_pesanan = $_POST['id-pengecekan'];
    $query= "UPDATE pesanan SET status_pesanan='dikirim' WHERE id_pesanan = $id_pesanan";
    $result= mysqli_query($conn, $query);
    if ($result) {
        echo "<script>
        alert('Status Berhasil Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    } else {
        echo "<script>
        alert('Status gagal Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    }
}

if (isset($_POST['status-selesai'])) {
    $id_pesanan = $_POST['id-pengecekan'];
    $query = "UPDATE pesanan SET status_pesanan='selesai' WHERE id_pesanan = $id_pesanan";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>
        alert('Status Berhasil Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    } else {
        echo "<script>
        alert('Status Gagal Diperbarui');
        document.location.href = 'konfirmasi_pesanan.php';
        </script>";
    }
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
    <title>Document</title>
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
                        <a href="#">Lihat Pesan dari User</a>
                        <a href="#">Hapus Pesan</a>
                    </div>
                </p>
                <a href="../util/logout.php">Log Out</a>
        </div>
    </nav>
<div class="isi-page-admin">
<div class="cek-pesanan">
        <?php
        if (empty($array_konfirmasi)) {
            echo "Tidak Ada Pesanan Yang perlu dikonfirmasi";
        } else {
            // Jika datanya ada, tampilkan form
        ?>
            <table>
                <tr>
                    <th>id_pesanan</th>
                    <th>id_pelanggan</th>
                    <th>total_pembayaran</th>
                    <th>tanggal_pesanan</th>
                    <th>status_pesanan</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($array_konfirmasi as $record_toconfirm) : ?>
                    <tr>
                        <td><?= $record_toconfirm['id_pesanan'] ?></td>
                        <td><?= $record_toconfirm['id_pelanggan'] ?></td>
                        <td><?= $record_toconfirm['total_pembayaran'] ?></td>
                        <td><?= $record_toconfirm['tanggal_pesanan'] ?></td>
                        <td><?= $record_toconfirm['status_pesanan'] ?></td>
                        <td>
                        <form action="" method="post">
                            <input type="number" name="id-pengecekan" value="<?= $record_toconfirm['id_pesanan'] ?>" hidden>
                            <button><a href="detail_bayar.php?id=<?=$record_toconfirm['id_pesanan']?>">Cek Detail pembayaran</button>
                            <button type="submit" name="status-diproses">Proses</button>
                            <button type="submit" name="status-dikirim">Kirim</button>
                            <button type="submit" name="status-selesai">Selesaikan</button>
                            <button type="submit" name="status-dibatalkan">Batalkan</button>
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php
        }
        ?>
    </div>
    <!-- <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="transaksi-pesanan">
                <?php
                if ($data_transaksi) {?>
                    <script>
                    // Display modal when the page loads
                    window.onload = function() {
                        openModal();
                    };
                    </script>
                    <h3>Id Transaksi : <?=$data_transaksi['id_transaksi']?></h3><br>
                    <img src="../bukti_transaksi/<?=$data_transaksi['bukti_pembayaran']?>" alt="bukti-pembayaran.png" width='50px'>
                    <p>Pesanan :<span><?=$data_transaksi['id_pesanan']?></span></p>
                    <p>Dari id rekening : <span><?=$data_transaksi['id_rekening']?></span></p>
                    <p>Dengan Rekening Tujuan :<span><?=$data_transaksi['rekening_tujuan']?></span></p>
                    <p>Tanggal : <span><?=$data_transaksi['tanggal_transaksi']?></span></p>
                    <p>Total Pembayaran <span><?=$data_transaksi['total_pembayaran']?></span></p>
                    
                    <form action="" method="post">
                        <p>Apakah Bukti Transfer Sudah Sesuai Dengan Pembayaran yang Seharusnya?</p>
                        <p>Silahkan Konfirmasi</p>
                        <input type="number" name="id-konfirmasi" value="<?= $data_transaksi['id_pesanan'] ?>" hidden>
                        <input type="submit" name="konfirmasi-diproses" value="Konfirmasi">
                        <input type="submit" name="konfirmasi-dibatalkan" value="dibatalkan">
                    </form>
                <?php
                } else {
                    echo "Data transaksi tidak tersedia.";
                }
                ?>
            </div>
        </div>
    </div> -->
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

</html>
