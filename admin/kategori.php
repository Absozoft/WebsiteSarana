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
        <div class="flex-1 p-6 text-white">

            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold mb-2">
                    <i class="fa-solid fa-tags mr-2"></i>Kelola Kategori
                </h2>
                <p class="text-gray-400 text-sm">Daftar semua kategori laporan yang tersedia</p>
            </div>

            <!-- Notifikasi -->
            <?php if (isset($_GET['pesan'])): ?>
                <div class="mb-6 p-4 rounded-lg text-sm <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' ?>">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                        <span class="font-semibold"><?= htmlspecialchars($_GET['pesan']) ?></span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Button Tambah Kategori -->
            <div class="mb-6">
                <a href="input-kategori.php" class="inline-flex items-center gap-2 px-4 py-2 bg-[#42506a] text-white rounded-lg hover:bg-[#5a6b8a] transition font-semibold text-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Kategori</span>
                </a>
            </div>

            <!-- Table Wrapper -->
            <div class="bg-[#ebf3f2] rounded-lg shadow-lg overflow-hidden">

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-[#0b1110]">
                        <thead class="bg-[#42506a] text-white">
                            <tr>
                                <th class="px-4 py-3 text-center font-semibold">ID</th>
                                <th class="px-4 py-3 text-left font-semibold">Nama</th>
                                <th class="px-4 py-3 text-left font-semibold hidden md:table-cell">Deskripsi</th>
                                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                                <th class="px-4 py-3 text-center font-semibold hidden lg:table-cell">Laporan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            <?php
                            include '../config/koneksi.php';
                            $query = mysqli_query($koneksi, "SELECT k.*, COUNT(p.id) as jumlah_laporan FROM kategori k LEFT JOIN pengaduan p ON k.id = p.kategori_id GROUP BY k.id");
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-4 py-3 text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 bg-[#42506a] text-white rounded font-bold text-xs">
                                            <?= $data["id"] ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-tag text-[#42506a] flex-shrink-0"></i>
                                            <span class="font-semibold"><?= htmlspecialchars($data["nama_kategori"]) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 hidden md:table-cell">
                                        <span class="line-clamp-2 text-sm"><?= htmlspecialchars($data["deskripsi"]) ?></span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="edit-kategori.php?id=<?= $data['id'] ?>" class="px-3 py-1.5 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600 transition font-semibold">
                                                Edit
                                            </a>
                                            <button onclick="confirmHapus(<?= $data['id'] ?>, '<?= htmlspecialchars($data['nama_kategori']) ?>')" class="px-3 py-1.5 bg-red-600 text-white rounded text-xs hover:bg-red-700 transition font-semibold">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center hidden lg:table-cell">
                                        <span class="inline-flex items-center justify-center px-3 py-1 bg-[#42506a] text-white rounded-full text-xs font-bold">
                                            <?= $data["jumlah_laporan"] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Info -->
                <div class="bg-[#42506a] text-white px-4 py-3 text-sm">
                    <i class="fa-solid fa-info-circle mr-2"></i>
                    Total Kategori: <span class="font-bold"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori")) ?></span>
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