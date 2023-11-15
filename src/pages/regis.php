<?php
require '../util/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $email = $_POST["email"];
    $hp = $_POST["hp"];

    $query = "INSERT INTO user (username, password, nama, alamat, email, no_hp) VALUES (?, ?, '$nama', '$alamat', '$email', '$hp')";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

    if (mysqli_stmt_execute($stmt)) {
        echo "
            <script>
            alert('Akun Berhasil Ditambahkan!');
            document.location.href = 'login.php';
            </script>
        ";
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../asset/logo.png">
    <link rel="stylesheet" href="../style/regis.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ngawi Sole</title>
</head>
<body>
<form action="" method="post">
    <div class="input">
        <h1>Registrasi Yak!</h1>
        <form action="" method="post">
            <div class="box-input">
            <i class="fa-solid fa-user"></i>
                <input type="text" placeholder="Username" name="username" id="input" required>
            </div>
            <div class="box-input">
                <i class="fa fa-lock"></i>
                <input type="password" placeholder="Password" name="password" id="input" required>
            </div>
            <div class="box-input">
                <i class="fa-solid fa-signature"></i>
                <input type="text" placeholder="Nama" name="nama" id="input" required>
            </div>
            <div class="box-input">
                <i class="fa-solid fa-address-book"></i>
                <input type="text" placeholder="Alamat" name="alamat" id="input" required>
            </div>
            <div class="box-input">
            <i class="fa fa-envelope-open-text"></i> 
                <input type="text" placeholder="Email" name="email" id="input" required>
            </div>
            <div class="box-input">
                <i class="fa-solid fa-address-card"></i>
                <input type="tel" placeholder="08XX XXXX XXXX" pattern="[0-9]{4}[0-9]{4}[0-9]{4}" name="hp" id="input" required>
            </div>
            <button type="submit" name="regis" class="btn-input">Sign In</button>
            <div class="bottom">
                <p>Sudah Terdaftar ?
                    <a href="login.php">Login Ulang Sini!</a>
                </p>
            </form>
    </div>
    </form> 
<!--     
    <form action="" method="post">
        <label for="">Username : </label>
        <input type="text" name="username" required><br>
        <label for="">Password : </label>
        <input type="password" name="password" required><br>
        <label for="">Nama : </label>
        <input type="text" name="nama" required><br>
        <label for="">Alamat : </label>
        <input type="text" name="alamat" required><br>
        <label for="">Email : </label>
        <input type="text" name="email" required><br>
        <label for="">No HP : </label>
        <input type="text" name="hp" step="any"required><br>
        <input type="submit" value="Register" name="register">
    </form> -->
</body>
</html>
