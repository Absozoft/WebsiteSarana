    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include 'middleware.php';
    ?>
</head>
<body>
    <form action="proses-kategori.php" method="POST">

        <input type="text" name="nama_kategori" placeholder="Nama Kategori"><br>

        <input type="text" name="deskripsi" placeholder="deskripsi"><br>

        <button type="submit" >KIRIM</button>
    </form>
</body>
</html>