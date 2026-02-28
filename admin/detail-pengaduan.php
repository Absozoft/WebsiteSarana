<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SiFast - Detail Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    // Ambil feedback yang ada
    $query_feedback = mysqli_query(
        $koneksi,
        "SELECT * FROM feedback WHERE pengaduan_id = '$id' ORDER BY tanggal_feedback DESC"
    );

    if (!$query_feedback) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $feedback_list = [];
    while ($row = mysqli_fetch_assoc($query_feedback)) {
        $feedback_list[] = $row;
    }
    ?>
</head>

<body class="bg-[#0b1110]">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include '../partial/sidebar.php'; ?>

    <!-- Content -->
    <div class="flex-1 p-4 sm:p-6 md:p-8 lg:p-10 text-white">

        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold mb-2">
                <i class="fa-solid fa-file-lines mr-2"></i>Detail Pengaduan
            </h2>
            <p class="text-gray-400 text-sm sm:text-base">Informasi lengkap mengenai laporan pengaduan dari siswa</p>
        </div>

        <!-- Card Container -->
        <div class="bg-[#ebf3f2] text-[#0b1110] rounded-lg sm:rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Header Card -->
            <div class="bg-[#42506a] px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                <h3 class="text-lg sm:text-2xl font-bold text-white flex items-start sm:items-center gap-2 sm:gap-3 break-words">
                    <i class="fa-solid fa-bullhorn flex-shrink-0 mt-1 sm:mt-0"></i>
                    <span><?= htmlspecialchars($data['judul']) ?></span>
                </h3>
            </div>

            <!-- Content Card -->
            <div class="p-4 sm:p-6 md:p-8">
                
                <!-- Grid Layout -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
                    
                    <!-- ID Pengaduan -->
                    <div class="bg-white p-4 sm:p-5 rounded-lg border-l-4 border-[#42506a] shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-hashtag text-[#42506a] text-base sm:text-lg flex-shrink-0"></i>
                            <p class="text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wide">ID Pengaduan</p>
                        </div>
                        <p class="text-lg sm:text-xl font-bold text-[#0b1110] ml-6 sm:ml-8">
                            #<?= htmlspecialchars($data['id']) ?>
                        </p>
                    </div>

                    <!-- Tanggal Lapor -->
                    <div class="bg-white p-4 sm:p-5 rounded-lg border-l-4 border-[#8086b0] shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-calendar-days text-[#8086b0] text-base sm:text-lg flex-shrink-0"></i>
                            <p class="text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wide">Tanggal Lapor</p>
                        </div>
                        <p class="text-lg sm:text-xl font-bold text-[#0b1110] ml-6 sm:ml-8">
                            <?= date('d F Y', strtotime($data['tanggal_lapor'])) ?>
                        </p>
                    </div>

                    <!-- Kategori -->
                    <div class="bg-white p-4 sm:p-5 rounded-lg border-l-4 border-[#a4c6c3] shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-tag text-[#a4c6c3] text-base sm:text-lg flex-shrink-0"></i>
                            <p class="text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wide">Kategori</p>
                        </div>
                        <div class="ml-6 sm:ml-8">
                            <span class="inline-flex items-center gap-2 px-3 sm:px-4 py-1 sm:py-2 bg-[#42506a] text-white rounded-full text-xs sm:text-sm font-semibold">
                                <i class="fa-solid fa-tags flex-shrink-0"></i>
                                <span class="break-words"><?= !empty($data['nama_kategori']) ? htmlspecialchars($data['nama_kategori']) : 'Tidak ada kategori' ?></span>
                            </span>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="bg-white p-4 sm:p-5 rounded-lg border-l-4 border-red-400 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-location-dot text-red-400 text-base sm:text-lg flex-shrink-0"></i>
                            <p class="text-xs sm:text-sm font-semibold text-gray-600 uppercase tracking-wide">Lokasi Kejadian</p>
                        </div>
                        <p class="text-base sm:text-lg font-semibold text-[#0b1110] ml-6 sm:ml-8 break-words">
                            <?= htmlspecialchars($data['lokasi']) ?>
                        </p>
                    </div>

                </div>

                <!-- Deskripsi Section -->
                <div class="bg-white p-4 sm:p-6 rounded-lg border border-[#a4c6c3] shadow-sm mb-6 sm:mb-8">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-200">
                        <i class="fa-solid fa-align-left text-[#42506a] text-base sm:text-lg flex-shrink-0"></i>
                        <h4 class="text-base sm:text-lg font-bold text-[#0b1110] uppercase tracking-wide">Deskripsi Lengkap</h4>
                    </div>
                    <div class="prose prose-sm sm:prose max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap text-sm sm:text-base break-words"><?= htmlspecialchars($data['deskripsi']) ?></p>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="bg-white p-4 sm:p-6 rounded-lg border border-[#a4c6c3] shadow-sm mb-6 sm:mb-8">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-200">
                        <i class="fa-solid fa-circle-info text-[#42506a] text-base sm:text-lg flex-shrink-0"></i>
                        <h4 class="text-base sm:text-lg font-bold text-[#0b1110] uppercase tracking-wide">Status Pengaduan</h4>
                    </div>
                    <div class="mb-4">
                        <?php
                        $status_colors = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'proses' => 'bg-blue-100 text-blue-800',
                            'selesai' => 'bg-green-100 text-green-800',
                            'ditolak' => 'bg-red-100 text-red-800'
                        ];
                        $status_class = $status_colors[$data['status']] ?? 'bg-gray-100 text-gray-800';
                        ?>
                        <span class="inline-block px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm font-bold <?= $status_class ?>">
                            <?= ucfirst(htmlspecialchars($data['status'])) ?>
                        </span>
                    </div>
                </div>

                <!-- Feedback Section -->
                <div class="bg-white p-4 sm:p-6 rounded-lg border border-[#a4c6c3] shadow-sm">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6 pb-3 border-b border-gray-200">
                        <i class="fa-solid fa-comments text-[#42506a] text-base sm:text-lg flex-shrink-0"></i>
                        <h4 class="text-base sm:text-lg font-bold text-[#0b1110] uppercase tracking-wide">Feedback & Update Status</h4>
                    </div>

                    <!-- Daftar Feedback -->
                    <?php if (!empty($feedback_list)): ?>
                        <div class="mb-6 sm:mb-8">
                            <h5 class="text-sm sm:text-md font-bold text-[#0b1110] mb-3 sm:mb-4">Feedback yang Diberikan:</h5>
                            <div class="space-y-3 sm:space-y-4">
                                <?php foreach ($feedback_list as $fb): ?>
                                    <div class="bg-[#f5f5f5] p-3 sm:p-4 rounded-lg border-l-4 border-[#42506a]">
                                        <p class="text-gray-700 text-xs sm:text-sm leading-relaxed break-words"><?= nl2br(htmlspecialchars($fb['pesan'])) ?></p>
                                        <p class="text-gray-500 text-xs mt-2">
                                            <i class="fa-solid fa-clock mr-1"></i>
                                            <?= date('d F Y H:i', strtotime($fb['tanggal_feedback'])) ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <hr class="my-6 border-gray-200">
                        </div>
                    <?php endif; ?>

                    <!-- Form Tambah Feedback -->
                    <form method="POST" action="proses-feedback.php" class="space-y-4">
                        <input type="hidden" name="pengaduan_id" value="<?= $data['id'] ?>">

                        <!-- Status Select -->
                        <div>
                            <label for="status" class="block text-xs sm:text-sm font-bold text-[#0b1110] mb-2">
                                Ubah Status Pengaduan
                            </label>
                            <select name="status" id="status" required 
                                    class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg bg-white text-[#0b1110] text-sm
                                           focus:outline-none focus:border-[#42506a] focus:ring-2 focus:ring-[#42506a]">
                                <option value="">-- Pilih Status --</option>
                                <option value="pending" <?= $data['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="proses" <?= $data['status'] === 'proses' ? 'selected' : '' ?>>Dalam Proses</option>
                                <option value="selesai" <?= $data['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                <option value="ditolak" <?= $data['status'] === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                        </div>

                        <!-- Feedback Textarea -->
                        <div>
                            <label for="pesan" class="block text-xs sm:text-sm font-bold text-[#0b1110] mb-2">
                                <i class="fa-solid fa-pen-to-square mr-2"></i>Pesan Feedback
                            </label>
                            <textarea name="pesan" id="pesan" rows="4" sm:rows="5" required placeholder="Masukkan feedback untuk pengguna..."
                                      class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg bg-white text-[#0b1110] text-sm
                                             focus:outline-none focus:border-[#42506a] focus:ring-2 focus:ring-[#42506a]
                                             placeholder-gray-400 resize-none"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-2">
                            <button type="submit" 
                                    class="flex-1 px-4 sm:px-6 py-2.5 sm:py-3 bg-[#42506a] text-white rounded-lg text-sm sm:text-base
                                           hover:bg-[#0b1110] transition duration-300 shadow-md font-semibold">
                                <i class="fa-solid fa-paper-plane mr-2"></i>Kirim Feedback
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Footer Card -->
            <div class="bg-gray-50 px-4 sm:px-6 md:px-8 py-4 sm:py-6 border-t border-gray-200">
                <a href="data-pengaduan-admin.php"
                   class="inline-flex items-center justify-center sm:justify-start gap-2 w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-3 bg-[#42506a] text-white rounded-lg text-sm sm:text-base
                          hover:bg-[#0b1110] transition duration-300 shadow-md font-semibold">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Kembali ke Daftar Pengaduan</span>
                </a>
            </div>

        </div>

    </div>

</div>

</body>
</html>