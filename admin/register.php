<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include '../config/koneksi.php';
    include 'middleware.php';
    ?>
</head>
<body>
    <form action="proses-register.php" method="POST">
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>

        <input type="text" name="nis" placeholder="NIS" required>

        <input type="text" name="kelas" placeholder="Kelas" required>

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="email" name="email" placeholder="Email" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>

