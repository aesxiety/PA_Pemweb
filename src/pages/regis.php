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
    <title>Ngawi Sole</title>
</head>
<body>
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
    </form>
</body>
</html>