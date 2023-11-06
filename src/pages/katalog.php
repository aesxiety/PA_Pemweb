<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

$data_sepatu = mysqli_query($conn, "SELECT * FROM sepatu");
$data_sepatu_array = [];

while ($row = mysqli_fetch_assoc($data_sepatu)) {
    $data_sepatu_array[] = $row;
}

if (empty($data_sepatu_array)) {
    echo "<script>
            alert('Error Load Data');
            document.location.href = '../pages/UserPage.php';
        </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan</title>
</head>
<body>
    <div class="katalog">
        <?php foreach ($data_sepatu_array as $sepatu) : ?>
            <div class="card">
                <img src="../img/<?php echo $sepatu['sepatu_img']; ?>" alt="Image Sepatu" width='150' height='150'>
                <h3><?php echo $sepatu['nama_sepatu']; ?></h3>
                <p>ID Sepatu: <?php echo $sepatu['id_sepatu']; ?></p>
                <p>Jenis Sepatu: <?php echo $sepatu['jenis_sepatu']; ?></p>
                <a href="pesan.php?id_sepatu=<?php echo $sepatu['id_sepatu']; ?>">Pesan Sekarang</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
