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

// Get the message ID from the URL
if (isset($_GET['id'])) {
    $messageId = $_GET['id'];
    // Query to fetch the specific message
    $sql = "SELECT * FROM messages WHERE id_msg = $messageId";
    // Execute the query using your database connection (assuming you have one)
    $result = $conn->query($sql);
    
    if ($result->num_rows === 0) {
        // Message not found, handle this case
        header("Location: index.php");
        exit();
    }

    $message = $result->fetch_assoc();
} else {
    // Handle the case when 'id' is not provided in the URL
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Message</title>
</head>
<body>
    <h1>View Message</h1>
    <p>ID: <?php echo $message['id_msg']; ?></p>
    <p>Username: <?php echo $message['username']; ?></p>
    <p>Email: <?php echo $message['email']; ?></p>
    <p>Message: <?php echo $message['pesan']; ?></p>
    <img src="<?php echo $message['img_path']; ?>" alt="Message Image">
</body>
</html>
