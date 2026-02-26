<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SiFast - Kelola Kategori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php
    include 'middleware.php';
    ?>
</head>

<body class="bg-[#0b1110]">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <?php include '../partial/sidebar.php'; ?>
        <!-- =========================================== -->

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 p-10 text-white">

            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold mb-2">
                    <i class="fa-solid fa-tags mr-2"></i>Kelola Kategori
                </h2>
                <p class="text-gray-400">Daftar semua kategori laporan yang tersedia</p>
            </div>

            <!-- Notifikasi -->
            <?php if (isset($_GET['pesan'])): ?>
                <div class="mb-6 p-4 rounded-lg <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' ?>">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                        <span class="font-semibold"><?= htmlspecialchars($_GET['pesan']) ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Button Tambah Kategori -->
            <div class="mb-6">
                <a href="input-kategori.php" class="inline-flex items-center gap-2 px-6 py-3 bg-[#42506a] text-white rounded-lg hover:bg-[#8086b0] transition duration-300 shadow-lg font-semibold">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Kategori Baru</span>
                </a>
            </div>

            <!-- Table Wrapper -->
            <div class="bg-[#ebf3f2] rounded-2xl shadow-2xl overflow-hidden">

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed">
                        <thead>
                            <tr class="bg-[#42506a] text-white">
                                <th class="w-20 px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">ID</th>
                                <th class="w-48 px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Deskripsi</th>
                                <th class="w-48 px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Aksi</th>
                                <th class="w-52 px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Jumlah Laporan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#a4c6c3]">
                            <?php
                            //Koneksi
                            include '../config/koneksi.php';

                            //query
                            $query = mysqli_query($koneksi, "SELECT k.*, COUNT(p.id) as jumlah_laporan FROM kategori k LEFT JOIN pengaduan p ON k.id = p.kategori_id GROUP BY k.id");
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr class="bg-white hover:bg-[#f5f9f8] transition-colors">
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-10 h-10 bg-[#42506a] text-white rounded-full text-sm font-bold">
                                            <?= $data["id"] ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-[#0b1110]">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-tag text-[#42506a]"></i>
                                            <span class="font-semibold"><?= htmlspecialchars($data["nama_kategori"]) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-[#42506a] text-sm">
                                        <?= htmlspecialchars($data["deskripsi"]) ?>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="edit-kategori.php?id=<?= $data['id'] ?>"
                                                class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 
                                                  transition duration-300 shadow-md text-xs font-semibold">
                                                Edit
                                            </a>
                                            <button onclick="confirmHapus(<?= $data['id'] ?>, '<?= htmlspecialchars($data['nama_kategori']) ?>')"
                                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 
                                                       transition duration-300 shadow-md text-xs font-semibold">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-[#42506a] text-white rounded-full text-sm font-bold">
                                            <i class="fa-solid fa-clipboard-list"></i>
                                            <?= $data["jumlah_laporan"] ?> Laporan
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Info -->
                <div class="bg-[#42506a] px-6 py-4">
                    <p class="text-white text-sm">
                        <i class="fa-solid fa-info-circle mr-2"></i>
                        Total Kategori: <span class="font-bold"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")) ?></span>
                    </p>
                </div>

            </div>
            <!-- =========================================== -->

        </div>
        <!-- =========================================== -->

    </div>
    <script>
        function confirmHapus(id, nama) {
            if (confirm(`Apakah Anda yakin ingin menghapus kategori "${nama}"?`)) {
                window.location.href = `proses-hapus-kategori.php?id=${id}`;
            }
        }
    </script>
</body>

</html>