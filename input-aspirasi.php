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
    <div class="flex-1 p-10 text-white">

        <h1 class="text-3xl font-bold mb-8">
            Buat Laporan
        </h1>

        <div class="bg-[#ebf3f2] text-black rounded-2xl shadow-xl p-8 max-w-2xl">

            <form action="proses-pengaduan.php" method="POST" class="space-y-6">

                <!-- Judul -->
                <div>
                    <label class="block mb-2 font-semibold">Judul</label>
                    <input type="text" name="judul"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#42506a]"
                        placeholder="Masukkan judul laporan">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block mb-2 font-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#42506a]"
                        placeholder="Masukkan deskripsi laporan"></textarea>
                </div>

                <!-- Lokasi -->
                <div>
                    <label class="block mb-2 font-semibold">Lokasi</label>
                    <input type="text" name="lokasi"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#42506a]"
                        placeholder="Contoh: Kelas RPL">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block mb-2 font-semibold">Kategori</label>
                    <select name="kategori"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#42506a]">
                        <option value="1">Elektronik</option>
                    </select>
                </div>

                <!-- Foto -->
                <div>
                    <label class="block mb-2 font-semibold">Foto (URL atau Nama File)</label>
                    <input type="text" name="foto"
                        class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#42506a]"
                        placeholder="Masukkan nama file foto">
                </div>

                <!-- Button -->
                <div>
                    <button type="submit"
                        class="w-full bg-[#42506a] text-white py-3 rounded-xl
                               hover:bg-[#0b1110] transition duration-300 shadow-md hover:shadow-xl">
                        KIRIM LAPORAN
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>