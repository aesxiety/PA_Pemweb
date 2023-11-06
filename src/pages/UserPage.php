<?php
require "../util/loginSession.php";
require "../util/katalog.php";
echo "<script>
    alert('Selamat Datang $username ')
</script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/user_page_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="nav-bar">

            <div class="logo">
                <h1>ini logo</h1>
            </div>
            <ul class="nav-link">
                <li><a href=""><i class='bx bx-user' ></i></a></li>
                <li><a href="">akun</a></li>
                <li><a href="">Home</a></li>
                <li><a href="">How To Orfer</a></li>
                <li><a href="">About Us</a></li>
            </ul>
            <div class="tema">icon</div>

        </div>
    </nav> 

    <div class="katalog-sepatu">
        <div class="kategori">
            <a href="#" onclick="loadKatalog('ALL')">VIEW ALL</a>
            <a href="#" onclick="loadKatalog('MAN')">MAN</a>
            <a href="#" onclick="loadKatalog('WOMEN')">WOMEN</a>
            <a href="#" onclick="loadKatalog('UNISEX')">UNISEX</a>
        </div>
        <div class="card-container">
            <?php foreach ($data_sepatu_array as $sepatu) : ?>
                <div class="card" data-jenis="<?php echo $sepatu['jenis_sepatu']; ?>">
                    <img src="../img/<?php echo $sepatu['sepatu_img']; ?>" alt="Image Sepatu" width='150' height='150'>
                    <h3><?php echo $sepatu['nama_sepatu']; ?></h3>
                    <p>ID Sepatu: <?php echo $sepatu['id_sepatu']; ?></p>
                    <p>Jenis Sepatu: <?php echo $sepatu['jenis_sepatu']; ?></p>
                    <button><a href="pesanan.php?id_sepatu=<?php echo $sepatu['id_sepatu']; ?>">Pesan Sekarang</a></button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function loadKatalog(kategori) {
        var cards = document.querySelectorAll('.card');
        if (kategori === 'ALL') {
            // Tampilkan semua kartu jika kategori "VIEW ALL" dipilih
            cards.forEach(function (card) {
                card.style.display = 'block';
            });
        } else {
            // Sembunyikan semua kartu
            cards.forEach(function (card) {
                card.style.display = 'none';
            });

            // Tampilkan kartu yang sesuai dengan kategori yang dipilih
            cards.forEach(function (card) {
                if (card.getAttribute('data-jenis') === kategori) {
                    card.style.display = 'block';
                }
                });
        }   
        }
        </script>
        <div class="footers">
            <footer>
                <p>pe footer</p>
            </footer>
        </div>
</body>
</html>