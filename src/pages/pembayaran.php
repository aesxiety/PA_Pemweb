<?php
require "../util/loginSession.php";
require "../util/koneksi.php";

$queryselect = "SELECT * FROM pesanan
where id_pelanggan = $id_akun AND status_pesanan='belum dibayar'";
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

$query_select_rekening = "SELECT * FROM rekening_user WHERE id_pelanggan = $id_akun";
$result_select_rekening = mysqli_query($conn, $query_select_rekening);

$id_rekening = "";
$nama_bank = "";
$no_rekening = "";
$nama_rekening = "";

if(mysqli_num_rows($result_select_rekening) > 0) {
    $row_rekening = mysqli_fetch_assoc($result_select_rekening);
    $id_rekening = $row_rekening['id_rekening'];
    $nama_bank = $row_rekening['nama_bank'];
    $no_rekening = $row_rekening['no_rekening'];
    $nama_rekening = $row_rekening['nama_rekening'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $id_pesanan = mysqli_real_escape_string($conn, $_POST['id_pesanan']);
    $rekening_tujuan = mysqli_real_escape_string($conn, $_POST['rekening_tujuan']);
    $pembayaran = mysqli_real_escape_string($conn, $_POST['total-pembayaran']);
    
    //localtime
    date_default_timezone_set('Asia/Makassar');
    $localTimezone = new DateTimeZone('Asia/Makassar');
    $date = new DateTime('now', $localTimezone);
    $formattedDate = $date->format('Y-m-d H:i:s');
    //Upload Gambar
    $gambar = $_FILES['bukti_pembayaran']['name'];
    $explode = explode('.', $gambar);
    $ekstensi = strtolower(end($explode));
    $gambar_baru = $id_pesanan."-".$nama_bank."-".date("Y-m-d").".". $ekstensi;
    $tmp = $_FILES["bukti_pembayaran"]["tmp_name"];

    // Simpan data ke database
    if (move_uploaded_file($tmp, '../bukti_transaksi/'. $gambar_baru)) {
        $result = mysqli_query($conn, "INSERT INTO transaksi (id_pesanan, id_rekening, rekening_tujuan, total_pembayaran, tanggal_transaksi, bukti_pembayaran) 
            VALUES ($id_pesanan, $id_rekening, '$rekening_tujuan','$pembayaran', '$formattedDate', '$gambar_baru')");
        if ($result) {
            // Update status_pesanan to 'sudah dibayar' for the corresponding order
            $query_update_status = "UPDATE pesanan SET status_pesanan = 'sudah dibayar' WHERE id_pesanan = $id_pesanan";
            $result_update_status = mysqli_query($conn, $query_update_status);

            if ($result_update_status) {
                echo "<script>
                        alert('Transaksi berhasil diproses');
                        // document.location.href = 'UserPage.php';
                    </script>";
            } else {
                echo "Gagal memperbarui status pesanan. Silakan coba lagi.";
            }
            header("Location: UserPage.php");
            exit();
        } else {
            echo "Gagal menyimpan data ke database. Silakan coba lagi.";
        }
    }else {
        echo "Gagal mengunggah gambar. Pastikan Anda telah memilih file gambar yang benar.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
        .detail-pembayaran input{
            border: none;
            outline: none;
        }
        .rekening-info input{
            border: none;
            outline: none;
        }
        .rekening-info {
            display: none;
        }
    </style>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <div class="detail-pembayaran">
        <h3>Total Pembayaran :</h3>
        <input type="number" name="total-pembayaran" value="<?= $array_pesanan[0]['total_pembayaran']; ?>" readonly>
    </div>
    <div class="rekening-pengguna">
        <h3>Informasi Rekening Anda</h3>
        <?php if(empty($nama_bank) || empty($no_rekening) || empty($nama_rekening)) : ?>
            <p>Anda belum menyimpan informasi rekening.</p>
            <a href="tambah_rekening.php">buat rekening</a>
        <?php else : ?>
            <input type="number" value="<?=$id_rekening?>"hidden>
            <p>Nama Bank: <?= $nama_bank; ?></p>
            <p>Nomor Rekening: <?= $no_rekening; ?></p>
            <p>Nama Pemilik Rekening: <?= $nama_rekening; ?></p>
            <p><a href="edit_rekening.php">Edit Informasi Rekening</a></p>
        <?php endif; ?>
    </div>
    <br>
    <div class="rekening-tujuan">
        <h2>Pilih Rekening Tujuan</h2>
        <label for="bank-select">Pilih Bank:</label>
            <select id="bank-select" name="rekening_tujuan" onchange="showRekeningInfo()">
                <option value="" disabled selected>pilih-bank</option>
                <option value="mandiri">Bank Mandiri</option>
                <option value="bca">Bank BCA</option>
            </select>
            <div id="mandiri-info" class="rekening-info">
                <h3>Bank Mandiri</h3>
                <p>Nama Pemilik Rekening: John Doe</p>
                <p>Nomor Rekening:</p>
                <p><input type="number" id="mandiri-rekening" value="1234567890" readonly> 
                <button onclick="copyToClipboard('mandiri-rekening')">SALIN</button></p>
                <p>Cabang: Jakarta Pusat</p>
            </div>
            <div id="bca-info" class="rekening-info">
                <h3>Bank BCA</h3>
                <p>Nama Pemilik Rekening: Jane Doe</p>
                <p>Nomor Rekening:</p>
                <p><input type="number" id="bca-rekening" pattern="" value="9876543210" readonly> 
                <button onclick="copyToClipboard('bca-rekening')">Copy</button></p>
                <p>Cabang: Jakarta Selatan</p>
            </div>
    </div>
    <div class="form-pembayaran">
        <input hidden type="number" name="id_pesanan" value="<?= $array_pesanan[0]['id_pesanan']; ?>">
        <label for="bukti-pembayaran">Bukti Pembayaran:</label>
        <input type="file" id="bukti-pembayaran" name="bukti_pembayaran" accept="image/*" required>
        <br>
        <button type="submit">Proses Transaksi</button>
    </div>
</form>

<script>
    function showRekeningInfo() {
        var selectedBank = document.getElementById("bank-select").value;

        // Hide all rekening-info elements
        var rekeningInfos = document.querySelectorAll('.rekening-info');
        rekeningInfos.forEach(function (info) {
            info.style.display = 'none';
        });

        // Show the selected rekening-info element
        var selectedInfo = document.getElementById(selectedBank + "-info");
        if (selectedInfo) {
            selectedInfo.style.display = 'block';
        }
    }

    function copyToClipboard(elementId) {
            var textToCopy = document.getElementById(elementId).value;

            var input = document.createElement('input');
            input.setAttribute('value', textToCopy);
            document.body.appendChild(input);

            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
        }
</script>
</body>
</html>