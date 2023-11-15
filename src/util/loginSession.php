<?php
session_start();
// cek session user
if(!isset($_SESSION['logged'])){
    echo "<script> 
        alert('Anda Belum Login Broo');
        document.location.href = '../pages/login.php';
    </script>";
}else{
    // id_akun dari session
    if (isset($_SESSION['username'])) {
        $id_akun  = $_SESSION['id_akun']; 
        $username = $_SESSION['username'];
        $userType = $_SESSION['userType'];
    } else {
        echo "<script> 
                alert('Akun Tidak Ditemukan');
                document.location.href = '../pages/login.php';
            </script>";
    }
}
?>