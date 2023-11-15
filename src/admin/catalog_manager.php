<?php
require "../util/loginSession.php";
require "../util/katalog.php";
require "../util/koneksi.php";

if ($userType !== 'admin') {
    echo "<script>
        alert('kamu itu bukan admin');
        document.location.href = '../index.php';
    </script>";
}

// Query to fetch all products from the 'sepatu' table
$sql = "SELECT * FROM sepatu";
// Execute the query using your database connection (assuming you have one)
$result = $conn->query($sql);

// HTML for displaying the product catalog
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>
</head>
<body>
    <h1>Product Catalog</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        // Loop through the query results and display each product
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id_sepatu'] . "</td>";
            echo "<td>" . $row['nama_sepatu'] . "</td>";
            echo "<td>" . $row['jenis_sepatu'] . "</td>";
            echo "<td>" . $row['harga'] . "</td>";
            echo "<td>" . $row['deskripsi'] . "</td>";
            echo "<td><img src='../img/" . $row['sepatu_img'] . "' alt='Product Image' width='100'></td>";
            echo "<td><a href='../pages/edit_product.php?id=" . $row['id_sepatu'] . "'>Edit</a> | <a href='../util/delete_product.php?id=" . $row['id_sepatu'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
