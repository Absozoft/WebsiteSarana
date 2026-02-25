<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php
    include '../config/koneksi.php';
    include 'middleware.php';
    
    ?>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usernama</th>
                <th>Password</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM users");

            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $data["id"] ?></td>
                    <td><?= $data["nama"] ?></td>
                    <td>********</td>
                    <td><?= $data["email"] ?></td>
                    <td><?= $data["role"] ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>

    
</body>
</html>