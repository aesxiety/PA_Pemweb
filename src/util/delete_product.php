<?php
require "../util/loginSession.php";
require "../util/katalog.php";
require "../util/koneksi.php";

// Check if the user is an admin (you should define the criteria for admin users)
if ($userType !== 'admin') {
    // Redirect to an unauthorized page or handle unauthorized access as needed
    header("Location: ../index.php");
    exit();
}

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    // Delete the product from the database
    $sql = "DELETE FROM sepatu WHERE id_sepatu = $productId";
    // Execute the query using your database connection (assuming you have one)
    $result = $conn->query($sql);

    if ($result) {
        // Product deleted successfully
        header("Location: ../admin/manajemen_katalog.php");
        exit();
    } else {
        // Handle the case when the deletion fails
        echo "Error: " . $conn->error;
    }
}
?>
