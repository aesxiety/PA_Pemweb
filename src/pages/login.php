<?php
session_start();
require "../util/koneksi.php";

// deklarasi pengcekan kesalahan login
$verifikasi_login=true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['logged'] = true;
            $_SESSION['id_akun'] = $row['id_akun'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email']; // Set the email
            $_SESSION['userType'] = $row['type'];
            $userType = $row['type'];

            if ($userType == 'admin') {
                header("Location: ../admin/index.php");
            }elseif ($userType == "user") {
                header("Location: ../pages/UserPage.php");
            }
            exit();
        } else {
            $verifikasi_login = false;
            $error_value = 'password';
        }
    } else {
        $verifikasi_login = false;
        $error_value = 'username';
    }           
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../asset/logo.png">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ngawi Sole</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <div class="input">
        <h1>Log In Cuy!</h1>
        <?php if ($verifikasi_login == false) {
            echo "<p>Invailid $error_value</p>";}?>
        <form action="" method="post">
            <div class="container-form">
                <i class="fa fa-envelope-open-text"></i> 
                <input type="text" placeholder="Username" name="username" id="input" required>
            </div>
            <div class="container-form">
                <i class="fa fa-lock"></i>
                <input type="password" placeholder="Password" name="password" id="input" required>
            </div>
            <button type="submit" name="login" class="btn-input">Log In</button>
            <div class="links">
                Don't have account? <a href="../pages/regis.php">Sign Up Now</a>
            </div>
        </form>
    </div>
</body>
</html>
