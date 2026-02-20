<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Koneksi
            include '../config/koneksi.php';

            //query
            $query = mysqli_query($koneksi, "SELECT * FROM kategori");

            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $data["id"] ?></td>
                    <td><?= $data["nama_kategori"] ?></td>
                    <td><?= $data["deskripsi"] ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>