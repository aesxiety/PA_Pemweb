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

// Query to fetch all messages
$sql = "SELECT * FROM messages";
// Execute the query using your database connection (assuming you have one)
$result = $conn->query($sql);

// HTML for displaying the message list
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Message List</title>
    <link rel="icon" href="../asset/logo.png">
</head>
<body>
    <h1>Admin Message List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php
        // Loop through the query results and display each message
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id_msg'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['pesan'] . "</td>";
            echo "<td><a href='view_message.php?id=" . $row['id_msg'] . "'>View</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
