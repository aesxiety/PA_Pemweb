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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Rekening</title>
</head>
<body>
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

</body>
</html>
