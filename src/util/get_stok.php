<?php
// Koneksi ke database
require "koneksi.php";

// Ambil nilai produk_id dan ukuran_id dari kueri AJAX
$produkID = $_GET['produk_id'];
$ukuranID = $_GET['ukuran_id'];

// Lakukan query untuk mendapatkan stok berdasarkan produk dan ukuran
$query = "SELECT jumlah_stok FROM stok WHERE id_sepatu = ? AND ukuran = ?";

// Gunakan prepared statement
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $produkID, $ukuranID);

// Eksekusi statement
mysqli_stmt_execute($stmt);

// Ambil hasil query
mysqli_stmt_bind_result($stmt, $stok);

// Fetch hasil
mysqli_stmt_fetch($stmt);

// Tampilkan data stok
echo "Stok : $stok";

// Tutup statement
mysqli_stmt_close($stmt);

// Tutup koneksi
mysqli_close($conn);

?>