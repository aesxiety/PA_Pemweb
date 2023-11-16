<?php
require "koneksi.php";

if (isset($_GET['id'])) {
    // Ambil nilai id_detail_pesanan dari parameter GET
    $id_detail_pesanan = $_GET['id'];

    // Lakukan kueri penghapusan dari database berdasarkan $id_detail_pesanan
    $query_delete = "DELETE FROM detail_pesanan WHERE id_detail_pesanan = ?";
    $stmt_delete = $conn->prepare($query_delete);
    $stmt_delete->bind_param("i", $id_detail_pesanan);

    if ($stmt_delete->execute()) {
        // Penghapusan berhasil
        echo "<script>
                alert('Item pesanan berhasil dihapus.');
                document.location.href = '../pages/keranjang.php';
            </script>";
    } else {
        // Gagal menghapus
        echo "<script>
                alert('Gagal menghapus item pesanan: ' . $stmt_delete->error;);
                document.location.href = '../pages/keranjang.php';
            </script>";
    }

    // Tutup statement
    $stmt_delete->close();
} else {
    // Jika parameter id tidak ada
    echo "<script>
            alert('Parameter id tidak ditemukan');
            document.location.href = '../pages/keranjang.php';
        </script>";
}
?>
