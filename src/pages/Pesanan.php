<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

$queryselect = "SELECT * FROM pesanan
where id_pelanggan = $id_akun AND status_pesanan !='keranjang'";
$pesanan=mysqli_query($conn, $queryselect);

$array_pesanan =[];
while($row=mysqli_fetch_assoc($pesanan)){
    $array_pesanan[] =$row;
}
if (empty($array_pesanan)) {
    echo "<script>
            alert('Data pesanan kosong');
            document.location.href = 'UserPage.php';
        </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <li><a href="informasi_rekening.php" class="menu-item">Informasi Rekening</a></li>
                <li><a href="#" class="menu-item">Pesanan</li>
                <li><a href="#" class="menu-item">Chat </li>
                <li></li>
            </ul>
        </aside>

        <main>
        <div class="container-pesanan">
            <div class="kategori-pesanan">
                <a href="#" onclick="loadKatalog('semua')">Semua</a>
                <a href="#" onclick="loadKatalog('belum dibayar')">Belum Dibayar</a>
                <a href="#" onclick="loadKatalog('diproses')">Diproses</a>
                <a href="#" onclick="loadKatalog('dikirim')">Dikirim</a>
                <a href="#" onclick="loadKatalog('selesai')">Selesai</a>
                <a href="#" onclick="loadKatalog('dibatalkan')">Dibatalkan</a>
            </div>
            <hr>
            <div class="container-proses-pesanan">
                <?php foreach ($array_pesanan as $record_pesanan) : ?>
                    <div class="proses-pesanan" data-jenis="<?= $record_pesanan['status_pesanan']?>">
                        <div class="header-pesanan">
                            <hr>
                            <p>ID Pesanan: <?= $record_pesanan['id_pesanan'];?></p>
                            <p>Status Pesanan:<?= $record_pesanan['status_pesanan']?></p>
                        </div>
                        <hr>
                        <?php
                        $id_pesanan = $record_pesanan['id_pesanan'];
                        $result_detail_pesanan = mysqli_query($conn,"SELECT dtl.*, spt.* FROM detail_pesanan dtl
                            JOIN sepatu spt ON spt.id_sepatu = dtl.id_sepatu
                            WHERE dtl.id_pesanan = $id_pesanan");
                        $array_detail=[];
                        while ($row_detail_pesanan = mysqli_fetch_assoc($result_detail_pesanan)) {
                            $array_detail[]=$row_detail_pesanan; 
                        }
                        if (empty($array_detail)) {
                            echo "data kosong";
                        }
                        ?>
                            <?php foreach ($array_detail as $detail_pesanan) : ?>
                            <div class="detail-pesanan">
                            <div class="img-detail-pesanan">
                                <img src="../img/<?=$detail_pesanan['sepatu_img']?>" alt="img-sepatu" width='100' height='75'>
                                </div>
                                <div class="detail-pesanan">
                                    <p>Sepatu <?=$detail_pesanan['nama_sepatu']?></p>
                                    <p><?=$detail_pesanan['jumlah_sepatu']?> pcs</p>
                                </div> 
                                <div class="harga-satuan">
                                    <span><?=$detail_pesanan['harga_satuan']?></span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <div class="footer-pesanan">
                            <hr>
                            <p>Total Pembayaran: <?=$record_pesanan['total_pembayaran'];?></p>
                            <!-- jika belum bayar ngelink ke pembayaran.php jika sudah bayar neglink ke chat admin -->
                            <?php if ($record_pesanan['status_pesanan'] == 'belum dibayar') : ?>
                                <a href="pembayaran.php?id_pesanan=<?=$record_pesanan['id_pesanan']?>" class="btn-bayar">Bayar</a>
                            <?php elseif ($record_pesanan['status_pesanan'] == 'sudah dibayar') : ?>
                                <a href="chat_admin.php?id_pesanan=<?=$record_pesanan['id_pesanan']?>" class="btn-chat-admin">Chat Admin</a>
                            <?php endif; ?>
                        </div>
                        <hr>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
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

    <script>
        function loadKatalog(kategori) {
            var pesananElements = document.querySelectorAll('.proses-pesanan');
            pesananElements.forEach(function (prosesPesanan) {
                var statusPesanan = prosesPesanan.getAttribute('data-jenis');
                if (kategori === 'semua' || statusPesanan === kategori) {
                    prosesPesanan.style.display = 'block';
                } else {
                    prosesPesanan.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>