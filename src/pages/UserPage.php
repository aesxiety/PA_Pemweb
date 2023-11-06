<?php
require "../util/loginSession.php";
echo "<script>
    alert('Selamat Datang $username ')
</script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ini user</h1>
    <?php 
        echo "<h1> username anda $username </h1>";
        echo "<h1> username anda $userType </h1>";
    ?>
</body>
</html>