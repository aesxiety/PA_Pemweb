<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

$id_pelanggan = $id_akun;
// Cari pesanan yang memiliki status 'keranjang' untuk pelanggan tertentu
$query_cari_keranjang = "SELECT * FROM pesanan WHERE id_pelanggan = ? AND status_pesanan = 'keranjang'";
$stmt_cari_keranjang = $conn->prepare($query_cari_keranjang);
$stmt_cari_keranjang->bind_param("i", $id_pelanggan);
$stmt_cari_keranjang->execute();
$result_cari_keranjang = $stmt_cari_keranjang->get_result();

if ($result_cari_keranjang->num_rows > 0) {
    // Jika ada pesanan dengan status 'keranjang', ambil ID_Pesanan
    $row_keranjang = $result_cari_keranjang->fetch_assoc();
    $id_pesanan = $row_keranjang['id_pesanan'];
} else {
    // Jika tidak ada pesanan dengan status 'keranjang', buat pesanan baru
    $query_buat_pesanan = "INSERT INTO pesanan (id_pelanggan, total_pembayaran, tanggal_pesanan, status_pesanan) VALUES (?, 0, ?, 'keranjang')";
    $stmt_buat_pesanan = $conn->prepare($query_buat_pesanan);
    $stmt_buat_pesanan->bind_param("is", $id_pelanggan, $local_time);
    $stmt_buat_pesanan->execute();

    // Ambil ID_Pesanan yang baru dibuat
    $id_pesanan = $conn->insert_id;
}

$detailpesanan = mysqli_query($conn, "SELECT * FROM detail_pesanan dtl
JOIN user usr ON usr.id_akun =dtl.id_pelanggan
JOIN sepatu spt ON spt.id_sepatu = dtl.id_sepatu
JOIN pesanan psn ON psn.id_pesanan = dtl.id_pesanan
WHERE dtl.id_pelanggan = $id_akun AND psn.status_pesanan = 'keranjang'" );
$array_join = [];

while ($row = mysqli_fetch_assoc($detailpesanan)) {
    $array_join[] = $row;
}

if (empty($array_join)) {
    echo "<script>
            alert('Data pesanan kosong');
            document.location.href = 'UserPage.php';
        </script>";
}
if (isset($_POST["pesan"])) {
    $total_pembayaran = $_POST['total-pembayaran-input'];
    $id_pelanggan = $id_akun;
    $local_time = $_POST["local-time"];

    // Cari pesanan yang memiliki status 'keranjang' untuk pelanggan tertentu
    $query_cari_keranjang = "SELECT * FROM pesanan WHERE id_pelanggan = ? AND status_pesanan = 'keranjang'";
    $stmt_cari_keranjang = $conn->prepare($query_cari_keranjang);
    $stmt_cari_keranjang->bind_param("i", $id_pelanggan);
    $stmt_cari_keranjang->execute();
    $result_cari_keranjang = $stmt_cari_keranjang->get_result();


    if ($result_cari_keranjang->num_rows > 0) {
        // Jika ada pesanan dengan status 'keranjang', ambil ID_Pesanan
        $row_keranjang = $result_cari_keranjang->fetch_assoc();
        $id_pesanan = $row_keranjang['id_pesanan'];

        // Update tanggal_pesanan dan status_pesanan
        $query_update_pesanan = "UPDATE pesanan SET tanggal_pesanan = ?,total_pembayaran = $total_pembayaran, status_pesanan = 'belum dibayar' WHERE id_pesanan = ?";
        $stmt_update_pesanan = $conn->prepare($query_update_pesanan);
        $stmt_update_pesanan->bind_param("si", $local_time, $id_pesanan);
        $stmt_update_pesanan->execute();
        
    } else {
        // Jika tidak ada pesanan dengan status 'keranjang', buat pesanan baru
        $query_buat_pesanan = "INSERT INTO pesanan (id_pelanggan, total_pembayaran, tanggal_pesanan, status_pesanan) VALUES (?, $total_pembayaran, ?, 'keranjang')";
        $stmt_buat_pesanan = $conn->prepare($query_buat_pesanan);
        $stmt_buat_pesanan->bind_param("is", $id_pelanggan, $local_time);
        $stmt_buat_pesanan->execute();

        // Ambil ID_Pesanan yang baru dibuat
        $id_pesanan = $conn->insert_id;
    }

    echo "<script>
            alert('Pesanan berhasil di-checkout');
            document.location.href = 'UserPage.php';
        </script>";
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="../asset/logo.png">
    <link rel="stylesheet" href="../style/k.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Keranjang</title>
</head>
<body onload="setLocalTime()">
<a href="UserPage.php">
    <i class="fa-solid fa-backward"></i> Back</a>
    <h1>Data Pesanan</h1>
    <form action="" method="post" class="centered-form">
    <?php foreach ($array_join as $pesanan_item) : ?>
        <div class="cart-item">
            <a href='../util/delete_keranjang.php?id=<?= $pesanan_item['id_detail_pesanan'] ?>'>Hapus</a>
            <img src='../img/<?= $pesanan_item['sepatu_img'] ?>' alt='Image Sepatu' width='150' height='150'>
            <div class="item-details">
                <p>Ukuran Sepatu: <?= $pesanan_item['ukuran_sepatu'] ?></p>
                <p>Nama Sepatu: <?= $pesanan_item['nama_sepatu'] ?></p>
                <p>Harga: <?= $pesanan_item['harga'] ?></p>
                <div class='input-jumlah'>
                    <p>Jumlah Sepatu: </p>
                    <button type='button' onclick='decrement(this)'>-</button>
                    <input type='number' name='jumlah_sepatu[]' value='<?= $pesanan_item['jumlah_sepatu'] ?>' min='1' max='99' required>
                    <button type='button' onclick='increment(this)'>+</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="cart-total">
        <div id="total-pembayaran">Total Pembayaran: 0</div>
        <br>
        <button type="submit" name="pesan">CheckOut</button>
    </div>
    
    <!-- Hidden input fields -->
    <input type="number" name="total-pembayaran-input" id="total-pembayaran-input" value="0" hidden>
    <input type="datetime-local" name="local-time" id="local-time-input" hidden>
</form>

    
<!-- mengambil local datetime -->
<script>
    function setLocalTime() {
        var now = new Date();
        var localDatetime = now.toISOString().slice(0, 16);
        document.getElementById("local-time-input").value = localDatetime;
    }
</script>

<script>
    // Fungsi untuk decrement jumlah sepatu
    function decrement(button) {
        var input = button.nextElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 1 : value;
        value = value > 1 ? value - 1 : 1;
        input.value = value;
        updateTotalPembayaran();
    }

    // Fungsi untuk increment jumlah sepatu
    function increment(button) {
        var input = button.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 1 : value;
        value = value < 99 ? value + 1 : 99;
        input.value = value;
        updateTotalPembayaran();
    }

    // Fungsi untuk menghitung total pembayaran
    function updateTotalPembayaran() {
        var totalPembayaran = 0;
        var inputs = document.getElementsByName('jumlah_sepatu[]');
        var hargaSatuan = <?php echo $pesanan_item['harga']; ?>; // Ubah dengan harga sepatu yang sesuai

        inputs.forEach(function (input) {
            var jumlahSepatu = parseInt(input.value, 10);
            totalPembayaran += jumlahSepatu * hargaSatuan;
        });

        // Tampilkan total pembayaran pada elemen dengan id 'total-pembayaran'
        document.getElementById('total-pembayaran').innerText = 'Total Pembayaran: ' + totalPembayaran;

        // Set nilai total pembayaran pada hidden input
        document.getElementById('total-pembayaran-input').value = totalPembayaran;
    }
    
    // Memanggil updateTotal saat halaman dimuat
    window.addEventListener('load', updateTotalPembayaran);
    
</script>
</body>
</html>

