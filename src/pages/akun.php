<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="path-to-your-fontawesome/css/all.css"> <!-- Ganti path dengan path sesuai tempat penyimpanan font-awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: right;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }

        header {
            display: flex;
        }

        aside {
            width: 250px;
            height: 100%;
            background-color: #333;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: auto; /* Mendorong footer ke bagian bawah */
        }

        .icon a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .footer ul li {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="../util/logout.php">Logout</a>
        <a href="UserPage.php">Kembali</a>    
    </nav>

    <header>
        <aside>
            <div class="dropdown">
                <a href="#" class="menu-link">Manajemen Akun</a>
                <div class="dropdown-content">
                    <a href="informasi_rekening.php" class="menu-item">Informasi Rekening</a>
                    <a href="pesanan.php" class="menu-item">Alamat Saya</a>
                </div>
            </div>

            <a href="#" class="menu-item">Pesanan Saya</a>

            <a href="#" class="menu-item">Chat Admin</a>
        </aside>

        <main>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
        </main>
    </header>

    <footer class="footer" id="setting">
        <div class="icon">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
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
            <p>Copyright 2023, Designed By Kelompok PA</p>
        </div>
    </footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Menangani perilaku dropdown
        var dropdown = document.querySelector('.dropdown');
        dropdown.addEventListener('mouseover', function () {
            dropdown.querySelector('.dropdown-content').style.display = 'block';
        });
        dropdown.addEventListener('mouseout', function () {
            dropdown.querySelector('.dropdown-content').style.display = 'none';
        });
    });
</script>
</body>
</html>
