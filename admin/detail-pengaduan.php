<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SiFast - Detail Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <?php
    session_start();
    include '../config/koneksi.php';

    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("ID pengaduan tidak valid!");
    }

    $id = $_GET['id'];

    $query = mysqli_query(
        $koneksi,
        "SELECT p.*, k.nama_kategori FROM pengaduan p 
         LEFT JOIN kategori k ON p.kategori_id = k.id 
         WHERE p.id = '$id'"
    );

    if (!$query) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        die("Pengaduan dengan ID $id tidak ditemukan!");
    }
    ?>
</head>

<body class="bg-[#0b1110]">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include '../partial/sidebar.php'; ?>

    <!-- Content -->
    <div class="flex-1 p-10 text-white">

        <h2 class="text-3xl font-bold mb-6">
            Detail Pengaduan
        </h2>

        <div class="bg-[#ebf3f2] text-[#0b1110] rounded-2xl shadow-2xl p-8 space-y-6">

            <div>
                <p class="text-sm text-gray-500">Judul</p>
                <p class="text-xl font-semibold">
                    <?= htmlspecialchars($data['judul']) ?>
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Deskripsi</p>
                <p>
                    <?= htmlspecialchars($data['deskripsi']) ?>
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Lokasi</p>
                <p>
                    <?= htmlspecialchars($data['lokasi']) ?>
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Kategori</p>
                <span class="inline-block px-4 py-1 bg-[#42506a] text-white rounded-full text-sm">
                    <?= !empty($data['nama_kategori']) ? htmlspecialchars($data['nama_kategori']) : 'Tidak ada kategori' ?>
                </span>
            </div>

            <div>
                <p class="text-sm text-gray-500">Tanggal</p>
                <p>
                    <?= date('d M Y', strtotime($data['tanggal_lapor'])) ?>
                </p>
            </div>

            <div class="pt-4">
            <input type="text" value="<?= $data['id']?>" readonly
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-700">
                <a href="data-pengaduan.php"
                   class="inline-block px-6 py-2 bg-[#42506a] text-white rounded-lg
                          hover:bg-[#0b1110] transition duration-300 shadow-md">
                    ← Kembali
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>