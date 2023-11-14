<?php
require "../util/loginSession.php";
require "../util/katalog.php";
require "../util/koneksi.php";

// Check if the user is an admin (you should define the criteria for admin users)
if ($userType !== 'admin') {
    // Redirect to an unauthorized page or handle unauthorized access as needed
    header("Location: unauthorized.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated product details from the form
    $productId = $_POST['id'];
    $productName = $_POST['name'];
    $productJenis = $_POST['jenis'];
    $productHarga = $_POST['harga'];
    $productDeskripsi = $_POST['deskripsi'];

    $imagePath = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../img/';
        $originalFileName = basename($_FILES['image']['name']);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        $newFileName = date("Y-m-d") . '-' . $originalFileName;
        $uploadedFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
            $imagePath = $uploadedFile;
        }
    }

    // Check if an image was uploaded and update the product in the database accordingly
    if (!empty($imagePath)) {
        $sql = "UPDATE sepatu SET nama_sepatu = '$productName', jenis_sepatu = '$productJenis', harga = '$productHarga', deskripsi = '$productDeskripsi', sepatu_img = '$imagePath' WHERE id_sepatu = $productId";
    } else {
        $sql = "UPDATE sepatu SET nama_sepatu = '$productName', jenis_sepatu = '$productJenis', harga = '$productHarga', deskripsi = '$productDeskripsi' WHERE id_sepatu = $productId";
    }

    // Execute the query using your database connection (assuming you have one)
    $result = $conn->query($sql);

    if ($result) {
        // Product updated successfully
        header("Location: ../pages/catalog_manager.php");
        exit();
    } else {
        // Handle the case when the update fails
        echo "Error: " . $conn->error;
    }
}
?>
