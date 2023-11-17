<?php
require "../util/loginSession.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="../asset/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            background-color:  #7720FE;
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
            width: 0p15x;
            height: 100%;
            background-color: #7750FE;
            color: #fff;
            padding: 19px;
            box-sizing: border-box;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        footer {
            background-color: #7720FE;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-top: auto;
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
        <a href="UserPage.php">Kembali</a>    
        <a href="../util/logout.php">Logout</a>
    </nav>

    <header>
        <aside>
            <ul>
                <li><a href="#" class="menu-link">Manajemen Akun</a></li>
                <li><a href="informasi_rekening.php" class="menu-item">Informasi Rekening</a></li>
                <li><a href="pesanan.php" class="menu-item">Pesanan</li>
                <li><a href="#" class="menu-item">Chat </li>
                <li></li>
            </ul>
        </aside>

        <main>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium earum sapiente dignissimos deleniti aspernatur, in libero est consectetur repellat provident nesciunt vero illo eius? Nemo aliquid rem obcaecati beatae pariatur?
            Quos vel qui dolore, tempora rerum illum incidunt ea porro ullam numquam nam odit ipsum tenetur laudantium cum mollitia, perspiciatis ipsa cupiditate fuga eveniet facere? Debitis asperiores ad exercitationem minima!
            Laboriosam non esse maiores quis dolor. Ullam aperiam doloremque nihil dignissimos dolorem quibusdam. Exercitationem nostrum dolorem consequuntur modi assumenda doloremque quis porro optio qui! Sit consequuntur modi reprehenderit voluptatem id.
            Ratione quos ad illum quod et magnam earum quidem praesentium! Dolorum cumque fugiat eveniet sint nisi accusamus aspernatur. Nihil, harum consectetur? Velit, minus natus. Laudantium reiciendis cumque minus repellat fugiat.
            Odio tempore iste rerum optio consectetur dignissimos excepturi eveniet ipsam voluptatibus aut, error vero corporis et alias beatae deserunt, porro vitae. Commodi est animi nostrum corporis nemo molestias porro harum?
            Cupiditate autem ipsam, quae impedit aliquam laborum animi eum iste asperiores id eligendi aliquid ducimus omnis laboriosam saepe praesentium sit reiciendis voluptatum numquam eos. Ut consectetur quidem deleniti ex dolorum?
            Delectus sapiente illum magni. Fugit voluptas ullam perferendis repellat molestias ex omnis, alias rerum accusamus accusantium recusandae necessitatibus voluptate a fuga, in dicta consectetur sunt hic consequuntur cupiditate non tenetur.
            Soluta nemo possimus officia, aliquam molestiae ea illo perspiciatis iusto impedit praesentium sit tenetur quos a aperiam veniam necessitatibus labore quae temporibus deserunt iste autem facere animi pariatur voluptatibus. Iure!
            Laborum neque ipsa tempore, deserunt nostrum, possimus iste maxime illum architecto porro, blanditiis similique. Soluta inventore omnis dolor nemo quae distinctio non assumenda, earum fugiat quisquam voluptas illo exercitationem molestiae?
            Sapiente, possimus quos! Nisi vitae quae provident impedit, facilis beatae ea inventore ut molestias atque ratione. Quos repellat culpa praesentium dolor et voluptatibus modi, quas hic, id harum repudiandae expedita.</p>
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
</body>
</html>
