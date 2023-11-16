<?php
require "../util/koneksi.php";
require "../util/loginSession.php";
require "../util/katalog.php";
// Make sure the user is logged in and obtain user data
if (!isset($_SESSION['logged'])) {
    // Redirect to the login page or handle authentication as needed
    header("Location: ../pages/login.php");
    exit();
}

if (isset($_SESSION['username'])) {
    $id_akun = $_SESSION['id_akun'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $userType = $_SESSION['userType'];
} else {
    // Handle the case where user data is not available
    header("Location: ../pages/login.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagePath = ''; 
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/'; 
        $originalFileName = basename($_FILES['image']['name']);
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        $newFileName = date("Y-m-d") . ' ' . $originalFileName;
        $uploadedFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
            $imagePath = $uploadedFile;
            }
        }

    // Insert the message into the database
    $pesan = $_POST['pesan'];
    $sql = "INSERT INTO messages (username, email, pesan, img_path) VALUES ('$username', '$email', '$pesan', '$imagePath')";
    // Execute the SQL query using your database connection (assuming you have one)
    $conn->query($sql);

    // Redirect back to the contact form page with a success message
    header("Location: ../pages/TG_CONTACT.php?success=1");
    exit();
}
?>
