<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SiFast - Edit Kategori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php
    include 'middleware.php';
    include '../config/koneksi.php';

    // Ambil ID dari URL
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: kategori.php?pesan=ID tidak valid&status=gagal");
        exit();
    }

    $id = $_GET['id'];

    // Ambil data kategori berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);

    if (!$data) {
        header("Location: kategori.php?pesan=Kategori tidak ditemukan&status=gagal");
        exit();
    }
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
                    <i class="fa-solid fa-pen-to-square mr-2"></i>Edit Kategori
                </h2>
                <p class="text-gray-400">Ubah informasi kategori laporan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-[#ebf3f2] rounded-2xl shadow-2xl overflow-hidden max-w-3xl">
                
                <!-- Header Card -->
                <div class="bg-[#42506a] px-8 py-6">
                    <h3 class="text-xl font-bold text-white flex items-center gap-3">
                        <i class="fa-solid fa-tag"></i>
                        Form Edit Kategori
                    </h3>
                </div>

                <!-- Form -->
                <form action="proses-edit-kategori.php" method="POST" class="p-8 space-y-6">
                    
                    <!-- Hidden ID -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']) ?>">

                    <?php if (isset($_GET['pesan'])): ?>
                        <div class="p-4 rounded-lg <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' ?>">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                                <span><?= htmlspecialchars($_GET['pesan']) ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Nama Kategori -->
                    <div>
                        <label class="flex items-center gap-2 text-[#0b1110] font-semibold mb-2">
                            <i class="fa-solid fa-tag text-[#42506a]"></i>
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nama_kategori" 
                            value="<?= htmlspecialchars($data['nama_kategori']) ?>"
                            placeholder="Contoh: Fasilitas, Keamanan, Kebersihan" 
                            class="w-full px-4 py-3 rounded-lg border-2 border-[#a4c6c3] 
                                   focus:outline-none focus:border-[#42506a] text-[#0b1110]
                                   transition-colors"
                            required
                        >
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="flex items-center gap-2 text-[#0b1110] font-semibold mb-2">
                            <i class="fa-solid fa-align-left text-[#42506a]"></i>
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            name="deskripsi" 
                            rows="4"
                            placeholder="Jelaskan kategori ini untuk apa..."
                            class="w-full px-4 py-3 rounded-lg border-2 border-[#a4c6c3] 
                                   focus:outline-none focus:border-[#42506a] text-[#0b1110]
                                   transition-colors resize-none"
                            required
                        ><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 px-6 py-3 bg-[#42506a] text-white rounded-lg 
                                   hover:bg-[#8086b0] transition duration-300 shadow-lg 
                                   font-semibold flex items-center justify-center gap-2"
                        >
                            <i class="fa-solid fa-save"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                        <a 
                            href="kategori.php"
                            class="px-6 py-3 bg-gray-500 text-white rounded-lg 
                                   hover:bg-gray-600 transition duration-300 shadow-lg 
                                   font-semibold flex items-center justify-center gap-2"
                        >
                            <i class="fa-solid fa-times"></i>
                            <span>Batal</span>
                        </a>
                    </div>

                </form>

            </div>

        </div>
        <!-- =========================================== -->

    </div>

</body>

</html>
