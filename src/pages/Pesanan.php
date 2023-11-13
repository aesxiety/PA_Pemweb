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
    .detail-pesanan {
        display: flex;
        align-items: center;
        justify-content: space-around;
        margin-bottom: 10px;
    }

    .img-detail-pesanan img {
        margin-right: 10px; /* Adjust as needed */
    }
</style>
</head>
<body>
<a href="akun.php">kembali</a>
<br>
<br>
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
                <hr>
                <div class="footer-pesanan">
                    <p>Total Pembayaran: <?=$record_pesanan['total_pembayaran'];?></p>
                    <!-- jika belum bayar ngelink ke pembayaran.php jika sudah bayar neglink ke chat admin -->
                    <?php if ($record_pesanan['status_pesanan'] == 'belum dibayar') : ?>
                        <a href="pembayaran.php?id_pesanan=<?=$record_pesanan['id_pesanan']?>" class="btn-bayar">Bayar</a>
                    <?php elseif ($record_pesanan['status_pesanan'] == 'sudah dibayar') : ?>
                        <a href="chat_admin.php?id_pesanan=<?=$record_pesanan['id_pesanan']?>" class="btn-chat-admin">Chat Admin</a>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <hr>
        <?php endforeach; ?>
    </div>

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
<!-- <script>
    function loadKatalog(kategori) {
    var cards = document.querySelectorAll('.proses-pesanan');
    if (kategori === 'semua') {
        // Tampilkan semua kartu jika "semua" pesanan  dipilih
        cards.forEach(function (proses-pesanan) {
            card.style.display = 'block';
        });
    } else {
        // Sembunyikan semua kartu
        cards.forEach(function (proses-pesanan) {
            card.style.display = 'none';
        });

        // Tampilkan kartu yang sesuai dengan kategori yang dipilih
        cards.forEach(function (proses-pesanan) {
            if (card.getAttribute('data-jenis') === kategori) {
                card.style.display = 'block';
            }
            });
    }   
    }
    </script> -->
</div>
</body>
</html>