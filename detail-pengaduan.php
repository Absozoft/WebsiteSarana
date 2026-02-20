<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SiFast - Detail Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <?php
    session_start();
    include 'config/koneksi.php';

    $id = $_GET['id'];

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM pengaduan WHERE id = '$id'"
    );

    $data = mysqli_fetch_assoc($query);
    ?>
</head>

<body class="bg-[#0b1110]">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include 'partial/sidebar.php'; ?>

    <!-- Content -->
    <div class="flex-1 p-10 text-white">

        <h2 class="text-3xl font-bold mb-6">
            Detail Pengaduan
        </h2>

        <div class="bg-[#ebf3f2] text-[#0b1110] rounded-2xl shadow-2xl p-8 space-y-6">

            <div>
                <p class="text-sm text-gray-500">Judul</p>
                <p class="text-xl font-semibold">
                    <?= $data['judul'] ?>
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Deskripsi</p>
                <p>
                    <?= $data['deskripsi'] ?>
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Lokasi</p>
                <p>
                    <?= $data['lokasi'] ?>
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Kategori</p>
                <span class="inline-block px-4 py-1 bg-[#42506a] text-white rounded-full text-sm">
                    <?= $data['kategori_id'] ?>
                </span>
            </div>

            <div class="pt-4">
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