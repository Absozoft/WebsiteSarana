<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SiFast - Tambah Kategori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php
    include 'middleware.php';
    ?>
</head>
<body class="bg-[#0b1110]">

    <div class="flex flex-col min-h-screen md:flex-row">

        <!-- ================= SIDEBAR ================= -->
        <?php include '../partial/sidebar.php'; ?>
        <!-- =========================================== -->

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 p-6 text-white">

            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold mb-2">
                    <i class="fa-solid fa-plus-circle mr-2"></i>Tambah Kategori
                </h2>
                <p class="text-gray-400 text-sm">Buat kategori baru untuk laporan pengaduan</p>
            </div>

            <!-- Form Card -->
            <div class="bg-[#ebf3f2] rounded-lg shadow-lg overflow-hidden max-w-2xl">
                
                <!-- Form -->
                <form action="proses-kategori.php" method="POST" class="p-8 space-y-6">
                    
                    <?php if (isset($_GET['pesan'])): ?>
                        <div class="p-4 rounded-lg text-sm <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' ?>">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                                <span><?= htmlspecialchars($_GET['pesan']) ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Nama Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-[#0b1110] mb-2">
                            Nama Kategori
                        </label>
                        <input type="text" name="nama_kategori" placeholder="misal: Keamanan, Fasilitas, dll" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-[#0b1110] focus:outline-none focus:border-[#42506a] focus:ring-2 focus:ring-[#42506a]" required>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block text-sm font-semibold text-[#0b1110] mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" placeholder="Jelaskan kategori ini..." rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-[#0b1110] focus:outline-none focus:border-[#42506a] focus:ring-2 focus:ring-[#42506a] resize-none"></textarea>
                    </div>

                    <!-- Button Group -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-300">
                        <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                            <i class="fa-solid fa-save mr-2"></i>Simpan Kategori
                        </button>
                        <a href="kategori.php" class="flex-1 px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition font-semibold text-center">
                            <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>

                </form>
            </div>

        </div>

    </div>

</body>

</html>
                        >
                            <i class="fa-solid fa-times"></i>
                            <span>Batal</span>
                        </a>
                    </div>

                </form>

            </div>

        </div>
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