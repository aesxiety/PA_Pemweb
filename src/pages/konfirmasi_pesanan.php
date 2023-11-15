<?php
require "../util/koneksi.php";
// require "../util/loginSession.php";

$result_query = mysqli_query($conn, "SELECT * FROM pesanan WHERE status_pesanan = 'sudah dibayar'");
$array_konfirmasi = [];

while ($row = mysqli_fetch_assoc($result_query)) {
    $array_konfirmasi[] = $row;
}

if (isset($_POST['cek-transaksi'])) {
    $cek_transaksi = $_POST['id-pengecekan'];
    $query = "SELECT * FROM transaksi WHERE id_pesanan = $cek_transaksi";
    $select_data_transaksi = mysqli_query($conn, $query);

    if ($select_data_transaksi) {
        $data_transaksi = mysqli_fetch_assoc($select_data_transaksi);
    } else {
        echo "Transaksi tidak ditemukan.";
    }
} else {
    $data_transaksi = null;
}

if (isset($_POST['konfirmasi-diproses'])) {
    $id_pesanan = $_POST['id-konfirmasi'];
    $status_konfirmasi = $_POST['konfirmasi-diproses'];
    $query_diproses = "UPDATE pesanan SET status_pesanan='diproses' WHERE id_pesanan = $id_pesanan ";
    $result_diproses = mysqli_query($conn, $query_diproses);

    if ($result_diproses) {
        $status_pesanan = "Berhasil Diproses";
    } else {
        $status_pesanan = "Berhasil Diproses";
    }
}
if (isset($_POST['konfirmasi-dibatalkan'])) {
    $id_pesanan = $_POST['id-konfirmasi'];
    $status_konfirmasi = $_POST['konfirmasi-dibatalkan'];
    $query_dibatalkan = "UPDATE pesanan SET status_pesanan='dibatalkan' WHERE id_pesanan = $id_pesanan";
    $result_dibatalkan = mysqli_query($conn, $query_dibatalkan);

    if ($result_dibatalkan) {
        $status_pesanan = "Berhasil dibatalkan";
    } else {
        $status_pesanan = "Berhasil dibatalkan";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/konfirmasi_pesanan.css">
    <script src="../javascript/konfirmasi_pesanan.js"></script>
    <title>Document</title>
</head>
<body>
<nav class="nav-admin">
    <div class="show-more" onclick="toggleSubMenu()">=</div>
    <a href="UserPage.php" class="home">Home</a>
    <div class="welcome-text">Selamat Datang <?= $username ?></div>
    <div class="submenu" id="submenu">
        <p>
            <a href="javascript:void(0);" onclick="toggleDropdown('dropdown1')">Manajemen Katalog</a>
            <div class="dropdown" id="dropdown1">
                <a href="tambah.php">Tambah Item</a>
                <a href="catalog_manager.php">Ubah / Hapus Item</a>
            </div>
        </p>
        <p>
            <a href="javascript:void(0);" onclick="toggleDropdown('dropdown2')">Manajemen Pesanan</a>
            <div class="dropdown" id="dropdown2">
                <a href="#">Konfirmasi Pesanan</a>
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
                            <button type="submit" name="cek-transaksi">Cek Transaksi</button>
                        </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php
        }
        ?>
    </div>
    <div id="myModal" class="modal">
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
    </div>
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
    
    <script>
        // Display modal when the button is clicked
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Close modal when close button or outside the modal is clicked
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        // Close modal when the ESC key is pressed
        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode == 27) {
                closeModal();
            }
        };

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>

</body>

</html>
