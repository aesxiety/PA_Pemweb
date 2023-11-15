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

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    // Query to fetch the specific product
    $sql = "SELECT * FROM sepatu WHERE id_sepatu = $productId";
    // Execute the query using your database connection (assuming you have one)
    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        // Product not found, handle this case
        header("Location: product_not_found.php");
        exit();
    }

    $product = $result->fetch_assoc();
} else {
    // Handle the case when 'id' is not provided in the URL
    header("Location: product_not_found.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style/edit_produk.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form action="../util/update_product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id_sepatu']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $product['nama_sepatu']; ?>" required>
        <label for="jenis">Jenis Sepatu:</label>
        <select name="jenis" id="jenis">
            <option value="MAN" <?php if ($product['jenis_sepatu'] === 'MAN') echo 'selected'; ?>>Man</option>
            <option value="WOMAN" <?php if ($product['jenis_sepatu'] === 'WOMAN') echo 'selected'; ?>>Woman</option>
            <option value="UNISEX" <?php if ($product['jenis_sepatu'] === 'UNISEX') echo 'selected'; ?>>Unisex</option>
        </select>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" value="<?php echo $product['harga']; ?>" required>
        
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" required><?php echo $product['deskripsi']; ?></textarea>
        
        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image">
        
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
