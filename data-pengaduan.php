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

    include 'config/koneksi.php';

    $user_id = $_SESSION['user_id'];
    
    // Ambil parameter search dan status filter dari GET
    $search = isset($_GET['search']) && !empty(trim($_GET['search'])) ? mysqli_real_escape_string($koneksi, trim($_GET['search'])) : '';
    $status_filter = isset($_GET['status']) && !empty(trim($_GET['status'])) ? mysqli_real_escape_string($koneksi, trim($_GET['status'])) : '';
    
    // Query dasar
    $query_sql = "SELECT p.*, k.nama_kategori FROM pengaduan p 
                  LEFT JOIN kategori k ON p.kategori_id = k.id 
                  WHERE p.user_id = '$user_id'";
    
    // Tambahkan kondisi search jika ada parameter search
    if ($search !== '') {
        $query_sql .= " AND (p.judul LIKE '%$search%' OR p.deskripsi LIKE '%$search%' OR p.lokasi LIKE '%$search%' OR k.nama_kategori LIKE '%$search%')";
    }
    
    // Tambahkan kondisi filter status jika ada
    if ($status_filter !== '') {
        $query_sql .= " AND p.status = '$status_filter'";
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
        <?php include 'partial/sidebar.php'; ?>
        <!-- =========================================== -->

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 p-4 sm:p-6 md:p-8 lg:p-10 text-white">

            <h2 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6">
                Data Pengaduan Saya
            </h2>

            <!-- ================= SEARCH BOX ================= -->
            <div class="mb-4 sm:mb-6">
                <form method="GET" class="flex flex-col sm:flex-row gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($search) ?>"
                        placeholder="Cari judul, deskripsi, lokasi..." 
                        class="flex-1 px-3 sm:px-4 py-2 rounded-lg bg-[#1a2422] text-white border border-[#42506a] text-sm
                               focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400"
                    >
                    <select 
                        name="status"
                        class="px-3 sm:px-4 py-2 rounded-lg bg-[#1a2422] text-white border border-[#42506a] text-sm
                               focus:outline-none focus:border-[#a4c6c3]"
                    >
                        <option value="">-- Semua Status --</option>
                        <option value="pending" <?= $status_filter === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="proses" <?= $status_filter === 'proses' ? 'selected' : '' ?>>Proses</option>
                        <option value="selesai" <?= $status_filter === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option value="ditolak" <?= $status_filter === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    </select>
                    <button 
                        type="submit" 
                        class="px-4 sm:px-6 py-2 bg-[#42506a] text-white rounded-lg text-sm sm:text-base hover:bg-[#0b1110] 
                               transition duration-300 shadow-md font-semibold"
                    >
                        Cari
                    </button>
                    <?php if ($search !== '' || $status_filter !== ''): ?>
                        <a 
                            href="data-pengaduan.php" 
                            class="px-4 sm:px-6 py-2 bg-red-600 text-white rounded-lg text-sm sm:text-base hover:bg-red-700 text-center
                                   transition duration-300 shadow-md font-semibold"
                        >
                            Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            <!-- ============================================== -->

            <div class="bg-[#ebf3f2] rounded-lg sm:rounded-2xl shadow-2xl overflow-x-auto">

                <table class="w-full text-xs sm:text-sm text-left text-[#0b1110]">
                    <thead class="bg-[#42506a] text-white sticky top-0">
                        <tr>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3">ID</th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3">Judul</th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 hidden md:table-cell">Deskripsi</th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 hidden lg:table-cell">Lokasi</th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 hidden md:table-cell">Tanggal</th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 hidden md:table-cell">Kategori</th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3">Status</th>
                            <th class="px-2 sm:px-4 md:px-6 py-2 sm:py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($total_pengaduan > 0): ?>
                            <?php foreach ($pengaduan_list as $data) : ?>
                                <tr class="border-b hover:bg-[#a4c6c3] transition duration-200">

                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 font-semibold">
                                        #<?= htmlspecialchars($data["id"]) ?>
                                    </td>

                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 font-semibold">
                                        <span class="break-words line-clamp-2"><?= htmlspecialchars($data["judul"]) ?></span>
                                    </td>

                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 hidden md:table-cell">
                                        <span class="break-words line-clamp-2 text-xs"><?= htmlspecialchars(
                                            substr($data["deskripsi"], 0, 50) . (strlen($data["deskripsi"]) > 50 ? '...' : '')
                                        ) ?></span>
                                    </td>

                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 hidden lg:table-cell text-xs">
                                        <?= htmlspecialchars($data["lokasi"]) ?>
                                    </td>
                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 hidden md:table-cell text-xs">
                                       <?= date('d M Y', strtotime($data['tanggal_lapor'])) ?> 
                                    </td>

                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 hidden md:table-cell text-xs">
                                        <?= htmlspecialchars($data["nama_kategori"]) ?: '-' ?>
                                    </td>

                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4">
                                        <?php
                                        $status_colors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'proses' => 'bg-blue-100 text-blue-800',
                                            'selesai' => 'bg-green-100 text-green-800',
                                            'ditolak' => 'bg-red-100 text-red-800'
                                        ];
                                        $status_class = $status_colors[$data['status']] ?? 'bg-gray-100 text-gray-800';
                                        ?>
                                        <span class="inline-block px-2 sm:px-3 py-1 rounded-full text-xs font-bold <?= $status_class ?>">
                                            <?= ucfirst(htmlspecialchars($data['status'])) ?>
                                        </span>
                                    </td>

                                    <td class="px-2 sm:px-4 md:px-6 py-2 sm:py-4 text-center">
                                        <a href="detail-pengaduan.php?id=<?= $data['id'] ?>"
                                            class="px-2 sm:px-4 py-1 sm:py-2 bg-[#42506a] text-white rounded text-xs sm:text-base
                                          hover:bg-[#0b1110] transition duration-300 shadow-md inline-block">
                                            Detail
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-6 text-gray-500 text-xs sm:text-base">
                                    <?= $search !== '' || $status_filter !== '' ? 'Tidak ada pengaduan yang cocok dengan pencarian.' : 'Belum ada pengaduan.' ?>
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