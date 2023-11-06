<?php
require "../util/koneksi.php";

$id = $_GET["id_sepatu"];
if (isset($_GET["id_sepatu"])) {
    $query = "SELECT * FROM sepatu WHERE id_sepatu = $id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $data_pesanan_sepatu = mysqli_fetch_assoc($result);
 
    } else {
        echo "Sepatu tidak ditemukan.";
        exit;
    }

} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <?php foreach ($data_pesanan_sepatu as $sepatu) : ?>
                <div class="card" data-jenis="<?php echo $sepatu['jenis_sepatu']; ?>">
                    <img src="../img/<?php echo $sepatu['sepatu_img']; ?>" alt="Image Sepatu" width='150' height='150'>
                    <h3><?php echo $sepatu['nama_sepatu']; ?></h3>
                    <p>ID Sepatu: <?php echo $sepatu['id_sepatu']; ?></p>
                    <p>Jenis Sepatu: <?php echo $sepatu['jenis_sepatu']; ?></p>
                </div>
            <?php endforeach; ?>
    <h1>pesan</h1>
</body>
</html>