<?php
require "../util/loginSession.php";
require "../util/katalog.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/user_page_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../asset/logo.png">
    <link rel="stylesheet" href="../style/contact.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <title>landing Page Ngawi</title>
</head>
<body>
    <!-- <nav>
        <div class="nav-bar">

            <div class="logo">
                <h1>ini logo</h1>
            </div>
            <ul class="nav-link">
                <li><a href=""><i class='bx bx-user' ></i></a></li>
                <li><a href="akun.php">akun</a></li>
                <li><a href="">Home</a></li>
                <li><a href="">How To Orfer</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
            </ul>
            <div class="tema">icon</div>

        </div>
    </nav>  -->

    <!-- Bagian Navbar -->
    <nav>
        <input type="checkbox" name="" id="nav-button">
        <label for="nav-button">&#9776</label>

        <div class="logo">
                <img src="../asset/logo.png" alt=""> 
        </div>
        <ul>
            <li><a href="akun.php">Akun</a></li>
            <li><a href="UserPage.php">Home</a></li>
            <li><a href="howto.html">How To Order</a></li>
            <li><a href="aboutus.html">About US</a></li>
            <li><a href="keranjang.php">Keranjang</a></li>
            <li><i id="toggleDark" class="fa-solid fa-moon"></i>
        </ul>
    </nav>
    <header class="land" id="home">
        <img src="asset/Landing.png" alt="">
    </header>


    <!-- Bagian Isi Konten -->
    <
        <form action="../util/process_message.php" method="POST" enctype="multipart/form-data">
            <h2>Contact Us</h2>
            <label for="message">Message:</label>
            <textarea id="message" name="pesan" rows="4" required></textarea>
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <input type="submit" value="Submit">
        </form>
  

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
            <img src="../asset/logo.png" alt="" style="width: 50px; height: 50px;">
                <p>Copyright 2023,Designed By Kelompok PA</p>
            </div>
        </div>
        </footer>
</body>
</html>
