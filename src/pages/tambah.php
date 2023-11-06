<?php
require "../util/koneksi.php";
if(isset($_POST["tambah"])){
    // Ambil data dari formulir
    $nama_sepatu = $_POST["nama-sepatu"];
    $jenis_sepatu = strtoupper($_POST["jenis-sepatu"]);
    //Upload Gambar
    $gambar = $_FILES['sepatu_img'] ['name'];
    $explode = explode('.',$gambar);
    $ekstensi = strtolower(end($explode));
    $gambar_baru = date("Y-m-d") . " " . $nama_sepatu . "." . $ekstensi;
    $tmp = $_FILES["sepatu_img"] ['tmp_name'];

    // Simpan data ke database
    if (move_uploaded_file($tmp, '../img/'.$gambar_baru)){
        $result = mysqli_query($conn,"INSERT INTO sepatu (id_sepatu, nama_sepatu, jenis_sepatu, sepatu_img) 
        VALUES ('','$nama_sepatu', '$jenis_sepatu', '$gambar_baru')"); 
        }
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
    <form action="" method="post" enctype="multipart/form-data" >
        <div class="input-box">
            <label for="nama-sepatu">Masukan Nama Sepatu</label>
            <input type="text" name="nama-sepatu">
        </div>
        <div class="input-box">
            <label for="jenis-sepatu">Jenis Sepatu</label>
            <select name="jenis-sepatu" id="" required>
            <option value="" disabled selected>Pilih jenis sepatu</option>
                <option value="MAN" class="">MAN</option>
                <option value="WOMEN" class="">WOMEN</option>
                <option value="UNISEX" class="">UNISEX</option>
            </select>
        </div>
        <div class="input-box">
            <label for="sepatu_img"></label>
            <input type="file" name='sepatu_img'>
        </div>
        <button type="submit" name="tambah">Submit</button>
    </form>

</body>
</html>