<?php
require "../util/koneksi.php";
require "../util/loginSession.php";

if (isset($_GET["id"])) {
    $id_sepatu = $_GET["id"];
    $query = "SELECT * FROM sepatu WHERE id_sepatu = $id_sepatu";
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

if (isset($_POST["pesan"])) {
    $id_pelanggan = $id_akun;
    $sepatu_id = $id_sepatu;
    $total_pembayaran = 0;
    $local_time = $_POST["local-time"];
    $ukuran_sepatu = $_POST["ukuran-sepatu"];
    $jumlah_sepatu = $_POST["jumlah-sepatu"];
    $harga_satuan = $_POST['harga-satuan'];
    $total = $harga_satuan * $jumlah_sepatu;

    // Periksa apakah pesanan sudah ada untuk produk dan ukuran yang sama
    $query_check = "SELECT * FROM detail_pesanan WHERE id_pelanggan = ? AND id_sepatu = ? AND ukuran_sepatu = ?";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param("iii", $id_pelanggan, $sepatu_id, $ukuran_sepatu);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Pesanan sudah ada, update jumlah sepatu
        $row_check = $result_check->fetch_assoc();
        $id_pesanan_existing = $row_check['id_detail_pesanan'];

        $query_update = "UPDATE detail_pesanan SET jumlah_sepatu = jumlah_sepatu + ? WHERE id_detail_pesanan = ?";
        $stmt_update = $conn->prepare($query_update);
        $stmt_update->bind_param("ii", $jumlah_sepatu, $id_pesanan_existing);
        $stmt_update->execute();

        $stmt_update->close();
    } else {
        // Pesanan belum ada, tambahkan pesanan baru
        $stmt_insert = $conn->prepare("SELECT id_pesanan FROM pesanan WHERE id_pelanggan = ? AND status_pesanan = 'keranjang' LIMIT 1");
        $stmt_insert->bind_param("i", $id_pelanggan);
        $stmt_insert->execute();
        $result_insert = $stmt_insert->get_result();

        if ($result_insert->num_rows > 0) {
            // Jika sudah ada keranjang yang sedang berjalan, gunakan ID_Pesanan yang sudah ada
            $row_insert = $result_insert->fetch_assoc();
            $id_pesanan = $row_insert['id_pesanan'];
        } else {
            // Jika belum ada keranjang yang berjalan, buat pesanan baru
            $stmt_insert = $conn->prepare("INSERT INTO pesanan (id_pelanggan, total_pembayaran, tanggal_pesanan, status_pesanan) VALUES (?, ?, ?, 'Keranjang')");
            $stmt_insert->bind_param("iis", $id_pelanggan, $total_pembayaran, $local_time);
            $stmt_insert->execute();
            // Dapatkan ID_Pesanan baru
            $id_pesanan = $conn->insert_id;
        }

        // Tambahkan produk ke keranjang dengan ID_Pesanan yang sesuai
        $stmt = $conn->prepare("INSERT INTO detail_pesanan (id_pesanan, id_pelanggan, id_sepatu, ukuran_sepatu, harga_satuan, jumlah_sepatu, total_harga) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiiiii", $id_pesanan, $id_pelanggan, $id_sepatu, $ukuran_sepatu, $harga_satuan, $jumlah_sepatu, $total);
        $stmt->execute();

        $stmt->close();
    }

    $stmt_check->close();

    header("Location: UserPage.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../javascript/jquery.js"></script>
    <link rel="stylesheet" href="../style/create_pesanan_style.css">
    <title>Document</title>
</head>
<body>
    <a href="UserPage.php">Kembali</a>
    <div class="container-pesanan">
    <div class="card">
        <h1 name="produk" id="produk"><?php echo $data_pesanan_sepatu['nama_sepatu']; ?></h1>
        <img src="../img/<?php echo $data_pesanan_sepatu['sepatu_img']; ?>" alt="Image Sepatu" width='500'>
        <p>Nama Sepatu  :<?php echo $data_pesanan_sepatu['nama_sepatu']; ?></p>
        <p>Harga : <?php echo $data_pesanan_sepatu['harga'] ?> </p>
        <p>Jenis Sepatu : <?php echo $data_pesanan_sepatu['jenis_sepatu']; ?></p>
        <p>Deskripsi :</p>
        <p><?php echo $data_pesanan_sepatu['deskripsi']; ?></p>
    </div>
    <div class="order-form">
        <fieldset>
            <h3>Pesan Sepatu</h3>
            <p>Silahkan Masukan Detail Pesanan</p>
            <form action="" method="post" onsubmit="setLocalTime()">

                <!-- Menambahkan input tersembunyi untuk menyimpan harga satuan -->
                <input type="hidden" name="harga-satuan" value="<?php echo $data_pesanan_sepatu['harga']; ?>">
                <!-- Tampilkan stok secara live di sini -->
                <div id="stokContainer"></div>

                <div class="input-ukuran">
                    <label for="ukuran-sepatu">Size :</label>
                    <br>
                    <input type="radio" id="size33" name="ukuran-sepatu" value="33"  onchange="tampilkanStok()">
                    <label for="size33">33</label>

                    <input type="radio" id="size34" name="ukuran-sepatu" value="34"  onchange="tampilkanStok()">
                    <label for="size34">34</label>

                    <input type="radio" id="size35" name="ukuran-sepatu" value="35"  onchange="tampilkanStok()">
                    <label for="size36">36</label>

                    <input type="radio" id="size36" name="ukuran-sepatu" value="36"  onchange="tampilkanStok()">
                    <label for="size36">36</label>

                    <input type="radio" id="size37" name="ukuran-sepatu" value="37"  onchange="tampilkanStok()">
                    <label for="size37">37</label>

                    <input type="radio" id="size38" name="ukuran-sepatu" value="38"  onchange="tampilkanStok()">
                    <label for="size38">38</label>
                    <br>
                    <input type="radio" id="size39" name="ukuran-sepatu" value="39"  onchange="tampilkanStok()">
                    <label for="size39">39</label>

                    <input type="radio" id="size40" name="ukuran-sepatu" value="40"  onchange="tampilkanStok()">
                    <label for="size40">40</label>

                    <input type="radio" id="size41" name="ukuran-sepatu" value="41"  onchange="tampilkanStok()">
                    <label for="size41">41</label>

                    <input type="radio" id="size42" name="ukuran-sepatu" value="42"  onchange="tampilkanStok()">
                    <label for="size42">42</label>

                    <input type="radio" id="size43" name="ukuran-sepatu" value="43"  onchange="tampilkanStok()">
                    <label for="size43">43</label>

                    <input type="radio" id="size44" name="ukuran-sepatu" value="44"  onchange="tampilkanStok()">
                    <label for="size44">44</label>

                    <input type="radio" id="size45" name="ukuran-sepatu" value="45"  onchange="tampilkanStok()">
                    <label for="size45">45</label>

                    <input type="radio" id="size46" name="ukuran-sepatu" value="46" required  onchange="tampilkanStok()">
                    <label for="size45">46</label>
                </div>
                <br>
                <div class="input-jumlah">
                    <label for="jumlah-sepatu">Quantity :</label>
                    <button type="button" onclick="decrement()">-</button>
                    <input type="number" id="jumlah-sepatu" name="jumlah-sepatu" value="1" min="1" max="99" required>
                    <button type="button" onclick="increment()">+</button>
                </div>
                <br>
                <div id="total-harga">
                    <p>Total Harga: Rp<span id="harga"></span></p>
                </div>

                <!-- hidden input -->
                <input type="datetime-local" name="local-time" id="local-time-input" hidden>

                <div>
                    <button type="submit" name="pesan">Tambahkan Keranjang</button>
                </div>
            </form>      
        </fieldset>
    </div>
    </div>

<!-- mengambil local datetime -->
<script>
    function setLocalTime() {
        var now = new Date();
        var localDatetime = now.toISOString().slice(0, 16);
        document.getElementById("local-time-input").value = localDatetime;
    }
</script>

<!-- Script untuk menampilkan stok secara live menggunakan AJAX -->
<script>
    function tampilkanStok() {
        var produkID = <?php echo $id_sepatu;?>;
        var ukuranID = $("input[name='ukuran-sepatu']:checked").val();

        // Lakukan kueri AJAX untuk mendapatkan stok berdasarkan produk dan ukuran
        $.ajax({
            url: "../util/get_stok.php",
            type: "GET",
            data: { produk_id: produkID, ukuran_id: ukuranID },
            success: function(data) {
                $("#stokContainer").html(data);
            }
        });
    }
</script>

<!-- mengatur jumlah pesanan  -->
<script>
        // Fungsi untuk mengurangi jumlah sepatu
        function decrement() {
            var inputElement = document.getElementById('jumlah-sepatu');
            var currentValue = parseInt(inputElement.value, 10);

            if (currentValue > 1) {
                inputElement.value = currentValue - 1;
            }

            updateTotal();
        }

        // Fungsi untuk menambah jumlah sepatu
        function increment() {
            var inputElement = document.getElementById('jumlah-sepatu');
            var currentValue = parseInt(inputElement.value, 10);

            if (currentValue < 99) {
                inputElement.value = currentValue + 1;
            }

            updateTotal();
        }

        // Fungsi untuk mengupdate total harga
        function updateTotal() {
            var quantity = parseInt(document.getElementById('jumlah-sepatu').value, 10);
            var hargaPerSepatu = <?php echo $data_pesanan_sepatu['harga'] ?>; // Ganti dengan harga sepatu per unit atau ambil dari sumber data lainnya

            var totalHarga = quantity * hargaPerSepatu;

            document.getElementById('harga').textContent = totalHarga;

            // Memasukkan nilai total harga ke hidden input
            document.getElementById('total-harga-input').value = totalHarga;
        }

        // Menambah event listener untuk memantau perubahan pada input jumlah sepatu
        document.getElementById('jumlah-sepatu').addEventListener('input', updateTotal);
        
        // Memanggil updateTotal saat halaman dimuat
        window.addEventListener('load', updateTotal);
    
    </script>

</body>
</html>