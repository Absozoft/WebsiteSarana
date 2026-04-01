<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SiFast - Buat Laporan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <?php
    session_start();
    ?>
</head>

<body class="bg-[#0b1110] overflow-x-hidden">

    <div class="flex min-h-screen w-full">

        <!-- Sidebar -->
        <?php include 'partial/sidebar.php'; ?>

        <!-- Content -->
        <div class="flex-1 p-4 sm:p-6 md:p-8 lg:p-10 text-white">

            <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-8">
                Buat Laporan
            </h1>

            <div class="bg-[#ebf3f2] text-black rounded-lg sm:rounded-2xl shadow-xl p-4 sm:p-6 md:p-8 max-w-2xl">

                <form action="proses-pengaduan.php" method="POST" class="space-y-4 sm:space-y-6">
                    <?php if (isset($_GET['pesan'])): ?>
                        <div class="bg-red-100 text-red-700 p-3 sm:p-4 rounded-lg text-sm sm:text-base">
                            <?= htmlspecialchars($_GET['pesan']) ?>
                        </div>
                        <?php unset($_GET['pesan']); ?>
                    <?php endif; ?>
                    <!-- Judul -->
                    <div>
                        <label class="block mb-2 font-semibold text-sm sm:text-base">Judul</label>
                        <input type="text" name="judul"
                            class="w-full p-2 sm:p-3 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#42506a]"
                            placeholder="Masukkan judul laporan" required>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label class="block mb-2 font-semibold text-sm sm:text-base">Deskripsi</label>
                        <textarea name="deskripsi" rows="4"
                            class="w-full p-2 sm:p-3 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#42506a] resize-none"
                            placeholder="Masukkan deskripsi laporan" required></textarea>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label class="block mb-2 font-semibold text-sm sm:text-base">Lokasi</label>
                        <input type="text" name="lokasi"
                            class="w-full p-2 sm:p-3 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#42506a]"
                            placeholder="Contoh: Kelas RPL" required>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block mb-2 font-semibold text-sm sm:text-base">Kategori</label>
                        <select name="kategori"
                            class="w-full p-2 sm:p-3 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-[#42506a]" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="1">Elektronik</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-2">
                        <button type="submit"
                            class="flex-1 bg-[#42506a] text-white py-2 sm:py-3 rounded-lg text-sm sm:text-base
                               hover:bg-[#0b1110] transition duration-300 shadow-md hover:shadow-xl font-semibold">
                            KIRIM LAPORAN
                        </button>
                        <a href="data-pengaduan.php"
                            class="flex-1 bg-gray-500 text-white py-2 sm:py-3 rounded-lg text-sm sm:text-base text-center
                               hover:bg-gray-600 transition duration-300 shadow-md font-semibold">
                            BATAL
                        </a>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>