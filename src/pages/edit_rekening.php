<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

$id_akun = $id_akun; // Adjust how you retrieve id_akun from loginSession

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_bank = $_POST["nama_bank"];
    $no_rekening = $_POST["no_rekening"];
    $nama_rekening = $_POST["nama_rekening"];

    $query_update_rekening = "UPDATE rekening_user SET nama_bank = '$nama_bank', no_rekening = '$no_rekening', nama_rekening = '$nama_rekening' WHERE id_pelanggan = $id_akun";
    mysqli_query($conn, $query_update_rekening);
    echo "<script>alert('Informasi rekening berhasil diperbarui');</script>";
}

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
    <title>Edit Informasi Rekening</title>
</head>
<body>
    <a href="akun.php">kembali</a>
    <h2>Edit Informasi Rekening</h2>
    <br>
    <form action="" method="post">
        <label for="nama_rekening">Nama Pemilik Rekening:</label>
        <input type="text" id="nama_rekening" name="nama_rekening" value="<?= $nama_rekening ?>" required>
        <br>
        <label for="nama_bank">Nama Bank:</label>
        <input type="text" id="nama_bank" name="nama_bank" value="<?= $nama_bank ?>" required>
        <br>
        <label for="no_rekening">Nomor Rekening:</label>
        <input type="number" id="no_rekening" name="no_rekening" value="<?= $no_rekening ?>" required>
        <br>
        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>
