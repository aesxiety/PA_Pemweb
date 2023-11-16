<?php
require "koneksi.php";

$data_sepatu = mysqli_query($conn, "SELECT * FROM sepatu");
$data_sepatu_array = [];

while ($row = mysqli_fetch_assoc($data_sepatu)) {
    $data_sepatu_array[] = $row;
}

if (empty($data_sepatu_array)) {
    echo "<script>
            alert('Error Load Data');
            document.location.href = '../pages/UserPage.php';
        </script>";
}
?>