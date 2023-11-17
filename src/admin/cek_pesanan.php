<?php
require "../util/loginSession.php";
require "../util/koneksi.php";

if ($userType !== 'admin') {
    echo "<script>
        alert('kamu itu bukan admin');
        document.location.href = '../index.php';
    </script>";
}

if (isset($_GET["id"])) {
    $id_pesanan = $_GET["id"];
    $query = "SELECT * FROM transaksi WHERE id_pesanan = $id_pesanan";
    $select_data_transaksi = mysqli_query($conn, $query);

} else {
    echo "detail pembayaran tidak ditemukan";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../asset/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- start tag php untuk data transaksi ditemukan -->
<?php
    if ($select_data_transaksi) {
        $data_transaksi = mysqli_fetch_assoc($select_data_transaksi);?>
<!-- end tag php untuk data transaksi ditemukan -->
    <div class="transaksi-pesanan">
        <?=$data_transaksi['id_transaksi']?>
        <?=$data_transaksi['id_pesanan']?>
        <?=$data_transaksi['id_rekening']?>
        <?=$data_transaksi['rekening_tujuan']?>
        <?=$data_transaksi['total_pembayaran']?>
        <?=$data_transaksi['tanggal_transaksi']?>

        <img src="../bukti_transaksi/<?=$data_transaksi['bukti_pembayaran']?>" alt="bukti-pembayaran.png" width='500'>
        </div>
<!-- start tag php untuk data transaksi tidak ditemukan -->
<?php   
    } else {
        echo "Sepatu tidak ditemukan.";} ?>
<!-- end tag php untuk data transaksi tidak ditemukan -->
</body>
</html>







