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
    include 'config/koneksi.php';

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
    <?php include 'partial/sidebar.php'; ?>

    <!-- Content -->
    <div class="flex-1 p-10 text-white">

        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold mb-2">
                <i class="fa-solid fa-file-lines mr-2"></i>Detail Pengaduan
            </h2>
            <p class="text-gray-400">Informasi lengkap mengenai laporan pengaduan</p>
        </div>

        <!-- Card Container -->
        <div class="bg-[#ebf3f2] text-[#0b1110] rounded-2xl shadow-2xl overflow-hidden">
            
            <!-- Header Card -->
            <div class="bg-[#42506a] px-8 py-6">
                <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                    <i class="fa-solid fa-bullhorn"></i>
                    <?= htmlspecialchars($data['judul']) ?>
                </h3>
            </div>

            <!-- Content Card -->
            <div class="p-8">
                
                <!-- Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    
                    <!-- ID Pengaduan -->
                    <div class="bg-white p-5 rounded-lg border-l-4 border-[#42506a] shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-hashtag text-[#42506a] text-lg"></i>
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">ID Pengaduan</p>
                        </div>
                        <p class="text-xl font-bold text-[#0b1110] ml-8">
                            #<?= htmlspecialchars($data['id']) ?>
                        </p>
                    </div>

                    <!-- Tanggal Lapor -->
                    <div class="bg-white p-5 rounded-lg border-l-4 border-[#8086b0] shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-calendar-days text-[#8086b0] text-lg"></i>
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Tanggal Lapor</p>
                        </div>
                        <p class="text-xl font-bold text-[#0b1110] ml-8">
                            <?= date('d F Y', strtotime($data['tanggal_lapor'])) ?>
                        </p>
                    </div>

                    <!-- Kategori -->
                    <div class="bg-white p-5 rounded-lg border-l-4 border-[#a4c6c3] shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-tag text-[#a4c6c3] text-lg"></i>
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Kategori</p>
                        </div>
                        <div class="ml-8">
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-[#42506a] text-white rounded-full text-sm font-semibold">
                                <i class="fa-solid fa-tags"></i>
                                <?= !empty($data['nama_kategori']) ? htmlspecialchars($data['nama_kategori']) : 'Tidak ada kategori' ?>
                            </span>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="bg-white p-5 rounded-lg border-l-4 border-red-400 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <i class="fa-solid fa-location-dot text-red-400 text-lg"></i>
                            <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Lokasi Kejadian</p>
                        </div>
                        <p class="text-lg font-semibold text-[#0b1110] ml-8">
                            <?= htmlspecialchars($data['lokasi']) ?>
                        </p>
                    </div>

                </div>

                <!-- Deskripsi Section -->
                <div class="bg-white p-6 rounded-lg border border-[#a4c6c3] shadow-sm">
                    <div class="flex items-center gap-3 mb-4 pb-3 border-b border-gray-200">
                        <i class="fa-solid fa-align-left text-[#42506a] text-lg"></i>
                        <h4 class="text-lg font-bold text-[#0b1110] uppercase tracking-wide">Deskripsi Lengkap</h4>
                    </div>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= htmlspecialchars($data['deskripsi']) ?></p>
                    </div>
                </div>

            </div>

            <!-- Footer Card -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <a href="data-pengaduan.php"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-[#42506a] text-white rounded-lg
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