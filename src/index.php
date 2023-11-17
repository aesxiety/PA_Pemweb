<?php
require "util/katalog.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="asset/logo.png">
    <link rel="stylesheet" href="style/userp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Landing Page Ngawi</title>
</head>
<body>

    <!-- Bagian Navbar -->
    <nav>
        <input type="checkbox" name="" id="nav-button">
        <label for="nav-button">&#9776</label>

        <div class="logo">
                <img src="asset/logo.png" alt=""> 
        </div>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="pages/howto.php">How To Order</a></li>
            <li><a href="pages/aboutus.html">About US</a></li>
            <li><a href="keranjang.html">Keranjang</a></li>
            <li><a href="pages/login.php">Login | Regist</a></li>
            <li><i id="toggleDark" class="fa-solid fa-moon"></i>
        </ul>
    </nav>
    <header class="land" id="home" style="width: 100% ">
        <img src="asset/darklanding.png" alt="">
    </header>

    <!-- Bagian Isi Konten -->

    <div class="katalog-sepatu">
        <div class="kategori">
            <a href="#" onclick="loadKatalog('ALL')">View All</a>
            <a href="#" onclick="loadKatalog('MAN')">Man</a>
            <a href="#" onclick="loadKatalog('WOMEN')">Women</a>
            <a href="#" onclick="loadKatalog('UNISEX')">Unisex</a>
        </div>
        <div class="card-container">
            <?php foreach ($data_sepatu_array as $sepatu) : ?>
                <div class="card" data-jenis="<?php echo $sepatu['jenis_sepatu']; ?>">
                    <img src="img/<?php echo $sepatu['sepatu_img']; ?>" alt="Image Sepatu" width='150' height='150'>
                    <h3><?php echo $sepatu['nama_sepatu']; ?></h3>
                    <p>Jenis Sepatu: <?php echo $sepatu['jenis_sepatu']; ?></p>
                    <p>Harga Sepatu: <?php echo $sepatu['harga']?></p>
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

        document.getElementById('searchInput').addEventListener('keyup', function () {
            var input, filter, cards, card, title, i;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            cards = document.querySelectorAll('.card');

            for (i = 0; i < cards.length; i++) {
                card = cards[i];
                title = card.getElementsByTagName('h3')[0];

                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            }
        });

        var button = document.getElementById("toggleDark");

        button.addEventListener("click", function() {
            this.classList.toggle('fa-moon')
            this.classList.toggle('fa-sun')
        
            document.querySelector("body").classList.toggle("dark");
            var img = document.querySelector(".land > img");
            if (img.src.endsWith("darkpic.png")) {
                img.src = "../asset/lightpic.png";
            } else {
                img.src = "../asset/darkpic.png";
            }
            }
        )
        </script>

        <!-- Bagian Footer -->
        <footer>
        <div class="footer" id="setting">
            <div class="icon">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footern">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Setting</a></li>
                    <li><a href="#">About Me</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footerb">
            <img src="asset/logo.png" alt="" style="width: 50px; height: 50px;">
                <br><p>Copyright 2023,Designed By Kelompok 7</p>
            </div>
        </div>
        </footer>
</body>
</html>