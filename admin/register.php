<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiFast - Registrasi Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php
    include '../config/koneksi.php';
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
            <div class="max-w-2xl mx-auto">
                <h2 class="text-3xl font-bold mb-8">
                    Registrasi Akun Baru
                </h2>

                <div class="bg-[#1a2422] rounded-2xl shadow-2xl p-8 border border-[#42506a]">
                    <form action="proses-register.php" method="POST" class="space-y-6">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Nama Lengkap</label>
                            <input 
                                type="text" 
                                name="nama_lengkap" 
                                placeholder="Masukkan nama lengkap" 
                                required
                                class="w-full px-4 py-3 rounded-lg bg-[#0b1110] text-white border border-[#42506a] 
                                       focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400 
                                       transition duration-300"
                            >
                        </div>

                        <!-- NIS -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">NIS</label>
                            <input 
                                type="text" 
                                name="nis" 
                                placeholder="Nomor Induk Siswa" 
                                required
                                class="w-full px-4 py-3 rounded-lg bg-[#0b1110] text-white border border-[#42506a] 
                                       focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400 
                                       transition duration-300"
                            >
                        </div>

                        <!-- Kelas -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Kelas</label>
                            <input 
                                type="text" 
                                name="kelas" 
                                placeholder="Contoh: X IPA 1" 
                                required
                                class="w-full px-4 py-3 rounded-lg bg-[#0b1110] text-white border border-[#42506a] 
                                       focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400 
                                       transition duration-300"
                            >
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Username</label>
                            <input 
                                type="text" 
                                name="username" 
                                placeholder="Username" 
                                required
                                class="w-full px-4 py-3 rounded-lg bg-[#0b1110] text-white border border-[#42506a] 
                                       focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400 
                                       transition duration-300"
                            >
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="Masukkan password" 
                                required
                                class="w-full px-4 py-3 rounded-lg bg-[#0b1110] text-white border border-[#42506a] 
                                       focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400 
                                       transition duration-300"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="Contoh: nama@email.com" 
                                required
                                class="w-full px-4 py-3 rounded-lg bg-[#0b1110] text-white border border-[#42506a] 
                                       focus:outline-none focus:border-[#a4c6c3] placeholder-gray-400 
                                       transition duration-300"
                            >
                        </div>

                        <!-- Submit Button -->
                        <div class="flex gap-4 pt-4">
                            <button 
                                type="submit"
                                class="flex-1 px-6 py-3 bg-[#42506a] text-white rounded-lg hover:bg-[#a4c6c3] 
                                       hover:text-[#0b1110] transition duration-300 shadow-md font-semibold"
                            >
                                Daftar
                            </button>
                            <a 
                                href="index.php"
                                class="flex-1 px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 
                                       transition duration-300 shadow-md font-semibold text-center"
                            >
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =========================================== -->
    </div>
</body>
</html>

