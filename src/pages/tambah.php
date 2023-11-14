<?php
require "../util/koneksi.php";

if (isset($_POST["tambah"])) {
    // Ambil data dari formulir
    $nama_sepatu = $_POST["nama-sepatu"];
    $jenis_sepatu = strtoupper($_POST["jenis-sepatu"]);
    $harga_sepatu = $_POST["harga-sepatu"];
    $deskripsi = $_POST["deskripsi-sepatu"];
    
    //Upload Gambar
    $gambar = $_FILES['sepatu_img']['name'];
    $explode = explode('.', $gambar);
    $ekstensi = strtolower(end($explode));
    $gambar_baru = "../img/". date("Y-m-d") . "-" . $nama_sepatu . "." . $ekstensi;
    $tmp = $_FILES["sepatu_img"]["tmp_name"];

    // Simpan data ke database
    if (move_uploaded_file($tmp, '../img/' . $gambar_baru)) {
        $result = mysqli_query($conn, "INSERT INTO sepatu (nama_sepatu, jenis_sepatu, harga, deskripsi, sepatu_img) 
            VALUES ('$nama_sepatu', '$jenis_sepatu', '$harga_sepatu','$deskripsi', '$gambar_baru')");

        if ($result) {
            header("Location: AdminPage.php");
            exit();
        } else {
            echo "Gagal menyimpan data ke database. Silakan coba lagi.";
        }
    } else {
        echo "Gagal mengunggah gambar. Pastikan Anda telah memilih file gambar yang benar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style_create_sepatu.css">
    <title>Document</title>
</head>
<body>
    <a href="AdminPage.php">Kembali</a>
    <form action="" method="post" enctype="multipart/form-data" >

        <div class="input-image">
            <label for="sepatu_img">Upload Image</label><br>
            <input type="file" id="gambar-input" name="sepatu_img" accept="image/*" required>
            <img id="gambar-preview" src="#" alt="Preview Gambar" style="display: none; max-width: 200px; max-height: 200px;">
        </div>

        <div class="input-box">
            <label for="nama-sepatu">Masukan Nama Sepatu</label>
            <input type="text" name="nama-sepatu" required>
        </div>
        
        <div class="input-box">
            <label for="harga-sepatu">Harga:</label>
            <input type="number" id="harga-sepatu" name="harga-sepatu" step="0.01" placeholder="Masukkan harga" required>
        </div>

        <div class="input-box">
            <label for="deskripsi">Masukan Deskripsi Sepatu</label>
            <textarea name="deskripsi-sepatu" rows="4" cols="50" maxlength="255" required placeholder="Ketikan Deskripsi [Maksimal 255 karakter] ..."></textarea>
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

        <button type="submit" name="tambah">Submit</button>
    </form>

    <script>
        // Ketika input gambar berubah, tampilkan preview gambar
        document.getElementById("gambar-input").addEventListener("change", function() {
            var preview = document.getElementById("gambar-preview");
            var file = this.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                preview.style.display = "none";
            }
        });
    </script>
</body>
</html>