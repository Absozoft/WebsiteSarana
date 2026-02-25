<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SiFast - Data Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <?php
    session_start();

    // Cegah akses jika belum login
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    include '../config/koneksi.php';

    // Ambil parameter search dari GET
    $search = isset($_GET['search']) && !empty(trim($_GET['search'])) ? mysqli_real_escape_string($koneksi, trim($_GET['search'])) : '';
    
    // Query dasar
    $query_sql = "SELECT p.*, k.nama_kategori, u.nis FROM pengaduan p 
                  LEFT JOIN users u ON p.user_id = u.id
                  LEFT JOIN kategori k ON p.kategori_id = k.id 
                  WHERE 1=1";
    
    // Tambahkan kondisi search jika ada parameter search
    if ($search !== '') {
        $query_sql .= " AND (p.judul LIKE '%$search%' OR p.deskripsi LIKE '%$search%' OR p.lokasi LIKE '%$search%' OR k.nama_kategori LIKE '%$search%' OR u.nis LIKE '%$search%')";
    }
    
    // Tambahkan ORDER BY
    $query_sql .= " ORDER BY p.tanggal_lapor DESC";
    
    $query = mysqli_query($koneksi, $query_sql);

    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $pengaduan_list = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $pengaduan_list[] = $row;
    }

    $total_pengaduan = count($pengaduan_list);
    ?>
</head>

<body class="bg-[#0b1110]">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <?php include '../partial/sidebar.php'; ?>
        <!-- =========================================== -->

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 p-10 text-white">

            <h2 class="text-3xl font-bold mb-6">
                Data Pengaduan Saya
            </h2>

            <!-- ================= SEARCH BOX ================= -->
            <div class="mb-6">
                <form method="GET" class="flex gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($search) ?>"
                        placeholder="Cari judul, deskripsi, lokasi, kategori, atau NIS..." 
                        class="flex-1 px-4 py-2 rounded-lg bg-[#1a2422] text-white border border-[#42506a] 
                               focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400"
                    >
                    <button 
                        type="submit" 
                        class="px-6 py-2 bg-[#42506a] text-white rounded-lg hover:bg-[#0b1110] 
                               transition duration-300 shadow-md font-semibold"
                    >
                        Cari
                    </button>
                    <?php if ($search !== ''): ?>
                        <a 
                            href="data-pengaduan-admin.php" 
                            class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 
                                   transition duration-300 shadow-md font-semibold"
                        >
                            Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            <!-- ============================================== -->

            <div class="bg-[#ebf3f2] rounded-2xl shadow-2xl overflow-hidden">

                <table class="w-full text-sm text-left text-[#0b1110]">
                    <thead class="bg-[#42506a] text-white">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">NIS</th>
                            <th class="px-6 py-3">Judul</th>
                            <th class="px-6 py-3">Deskripsi</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($total_pengaduan > 0): ?>
                            <?php foreach ($pengaduan_list as $data) : ?>
                                <tr class="border-b hover:bg-[#a4c6c3] transition duration-200">

                                    <td class="px-6 py-4">
                                        <?= htmlspecialchars($data["id"]) ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($data["nis"]) ?>
                                    </td>

                                    <td class="px-6 py-4 font-semibold">
                                        <?= htmlspecialchars($data["judul"]) ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?= htmlspecialchars($data["deskripsi"]) ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?= htmlspecialchars($data["lokasi"]) ?>
                                    </td>
                                    <td>
                                        <?= date('d M Y', strtotime($data['tanggal_lapor'])) ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?= htmlspecialchars($data["nama_kategori"]) ?: 'Tidak Diketahui' ?>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a href="detail-pengaduan.php?id=<?= $data['id'] ?>"
                                            class="px-4 py-2 bg-[#42506a] text-white rounded-lg
                                          hover:bg-[#0b1110] transition duration-300 shadow-md">
                                            Detail
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500">
                                    <?= $search !== '' ? 'Tidak ada pengaduan yang cocok dengan pencarian.' : 'Belum ada pengaduan.' ?>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>

        </div>
        <!-- =========================================== -->

    </div>

</body>

</html>