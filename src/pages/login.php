<?php
session_start();
require "../util/koneksi.php";
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
            $_SESSION['userType'] = $row['type'];
            $userType = $row['type'];

            if ($userType == 'admin') {
                header("Location: ../pages/AdminPage.php");
            }elseif ($userType == "user") {
                header("Location: ../pages/UserPage.php");
            }
            exit();
        } else {
            echo "
                <script>
                    alert('Invalid Password');
                    document.location.href = '../pages/login.php';
                </script>
                ";
        }
    } else {
        echo "  <script>
                    alert('Invalid Username');
                    document.location.href = '../pages/login.php';
                </script> ";
            }
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
    <div class="container-form">
        <form action="" method="post">
            <label for="" class="left">Username : </label>
            <input type="text" name="username" required><br>
            <label for="" class="left">Password : </label>
            <input type="password" name="password" required><br>
            <input type="submit" value="Login" name="login">
    
            <div class="links">
                Don't have account? <a href="../pages/regis.php">Sign Up Now</a>
            </div>
        </form>
    </div>
</body>
</html>