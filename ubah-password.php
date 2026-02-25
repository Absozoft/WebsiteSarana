<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
</head>
<body>
    <form action="proses-ubah-password.php" method="POST">
        <input type="password" name="current_password" placeholder="Password Lama" required><br>
        <input type="password" name="new_password" placeholder="Password Baru" required><br>
        <input type="password" name="confirm_password" placeholder="Konfirmasi Password Baru" required><br>
        <button type="submit">Ubah Password</button>
</body>
</html>