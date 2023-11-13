<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

// Ambil id_akun dari loginSession
$id_akun = $id_akun; // Sesuaikan dengan cara Anda mengambil id_akun dari loginSession

// Jika formulir disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama_bank = $_POST["nama_bank"];
    $no_rekening = $_POST["no_rekening"];
    $pemilik_rekening = $_POST["nama_rekening"];

    // Query untuk memeriksa apakah pengguna sudah memiliki rekening
    $query_cek_rekening = "SELECT * FROM rekening_user WHERE id_pelanggan = $id_akun";
    $result_cek_rekening = mysqli_query($conn, $query_cek_rekening);

    // Jika pengguna sudah memiliki rekening, lakukan UPDATE
    if(mysqli_num_rows($result_cek_rekening) > 0) {
        $query_update_rekening = "UPDATE rekening_user SET nama_bank = '$nama_bank', no_rekening = '$no_rekening', nama_rekening = '$pemilik_rekening' WHERE id_pelanggan = $id_akun";
        mysqli_query($conn, $query_update_rekening);
        echo "<script>alert('Informasi rekening berhasil diperbarui');</script>";
    } else {
        // Jika pengguna belum memiliki rekening, lakukan INSERT
        $query_insert_rekening = "INSERT INTO rekening_user (id_pelanggan, nama_rekening, nama_bank, no_rekening) VALUES ($id_akun, '$pemilik_rekening', '$nama_bank', '$no_rekening')";
        mysqli_query($conn, $query_insert_rekening);
        echo "<script>alert('Informasi rekening berhasil disimpan');</script>";
    }
}



// Query untuk memeriksa kembali apakah pengguna sudah memiliki rekening setelah pembaruan
$query_cek_rekening = "SELECT * FROM rekening_user WHERE id_pelanggan = $id_akun";
$result_cek_rekening = mysqli_query($conn, $query_cek_rekening);

// Inisialisasi variabel untuk data rekening
$nama_bank = "";
$no_rekening = "";
$nama_rekening = "";

// Periksa apakah rekening sudah ada
if(mysqli_num_rows($result_cek_rekening) > 0) {
    // Jika sudah memiliki rekening, ambil data rekening
    $row_rekening = mysqli_fetch_assoc($result_cek_rekening);
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
    <title>Form Data Rekening</title>
</head>
<body>
    <a href="akun.php">kembali</a>
    <br>
    <h2>Form Data Rekening</h2>
    <br>
    <?php if(empty($nama_bank) || empty($no_rekening) || empty($nama_rekening)) : ?>
        <!-- Jika rekening belum ada, tampilkan formulir input -->
        <form action="" method="post">
            <label for="nama_rekening">Nama Pemilik Rekening:</label>
            <input type="text" id="nama_rekening" name="nama_rekening" required>
            <br>
            <label for="nama_bank">Nama Bank:</label>
            <input type="text" id="nama_bank" name="nama_bank" required>
            <br>
            <label for="no_rekening">Nomor Rekening:</label>
            <input type="number" id="no_rekening" name="no_rekening" required>
            <br>
            <button type="submit">Simpan Rekening</button>
        </form>
    <?php else : ?>
        <!-- Jika rekening sudah ada, tampilkan informasi rekening -->
        <p>Anda sudah memiliki rekening dengan detail sebagai berikut:</p>
        <p>Nama Bank: <?= $nama_bank; ?></p>
        <p>Nomor Rekening: <?= $no_rekening; ?></p>
        <p>Nama Pemilik Rekening: <?= $nama_rekening; ?></p>
        <p><a href="edit_rekening.php">Edit Informasi Rekening</a></p>
    <?php endif; ?>

</body>
</html>
