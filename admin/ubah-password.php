<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiFast - Ubah Password Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php
    // Middleware untuk admin
    include 'middleware.php';
    include '../config/koneksi.php';
    ?>
</head>
<body class="bg-[#0b1110]">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <?php include '../partial/sidebar.php'; ?>
        <!-- =========================================== -->

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 p-4 sm:p-6 md:p-8 lg:p-10 text-white">

            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold mb-2">
                    <i class="fa-solid fa-key mr-2"></i>Ubah Password Admin
                </h2>
                <p class="text-gray-400 text-sm sm:text-base">Ubah password akun admin Anda untuk keamanan yang lebih baik</p>
            </div>

            <!-- Form Card -->
            <div class="bg-[#ebf3f2] rounded-lg sm:rounded-2xl shadow-2xl overflow-hidden max-w-2xl">
                
                <!-- Header Card -->
                <div class="bg-[#42506a] px-4 sm:px-6 md:px-8 py-4 sm:py-6">
                    <h3 class="text-lg sm:text-xl font-bold text-white flex items-center gap-2 sm:gap-3">
                        <i class="fa-solid fa-user-shield"></i>
                        <span>Form Ubah Password Admin</span>
                    </h3>
                </div>

                <!-- Form -->
                <form action="proses-ubah-password.php" method="POST" class="p-4 sm:p-6 md:p-8 space-y-4 sm:space-y-6">
                    
                    <?php if (isset($_GET['pesan'])): ?>
                        <div class="p-3 sm:p-4 rounded-lg text-sm sm:text-base <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' ?>">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid <?= isset($_GET['status']) && $_GET['status'] == 'sukses' ? 'fa-circle-check' : 'fa-circle-xmark' ?>"></i>
                                <span class="font-semibold"><?= htmlspecialchars($_GET['pesan']) ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Password Lama -->
                    <div>
                        <label class="flex items-center gap-2 text-[#0b1110] font-semibold mb-2 text-sm sm:text-base">
                            <i class="fa-solid fa-lock text-[#42506a] flex-shrink-0"></i>
                            <span>Password Lama <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_lama"
                                name="password_lama" 
                                placeholder="Masukkan password lama Anda" 
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 pr-10 sm:pr-12 rounded-lg border-2 border-[#a4c6c3] text-sm
                                       focus:outline-none focus:border-[#42506a] text-[#0b1110]
                                       transition-colors"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword('password_lama', this)"
                                class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 text-[#42506a] hover:text-[#0b1110]"
                            >
                                <i class="fa-solid fa-eye text-sm sm:text-base" id="icon-password_lama"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label class="flex items-center gap-2 text-[#0b1110] font-semibold mb-2 text-sm sm:text-base">
                            <i class="fa-solid fa-key text-[#42506a] flex-shrink-0"></i>
                            <span>Password Baru <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password_baru"
                                name="password_baru" 
                                placeholder="Masukkan password baru (min. 6 karakter)" 
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 pr-10 sm:pr-12 rounded-lg border-2 border-[#a4c6c3] text-sm
                                       focus:outline-none focus:border-[#42506a] text-[#0b1110]
                                       transition-colors"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword('password_baru', this)"
                                class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 text-[#42506a] hover:text-[#0b1110]"
                            >
                                <i class="fa-solid fa-eye text-sm sm:text-base" id="icon-password_baru"></i>
                            </button>
                        </div>
                        <p class="text-xs sm:text-sm text-gray-600 mt-1 ml-1">
                            <i class="fa-solid fa-info-circle"></i> Password minimal 6 karakter
                        </p>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="flex items-center gap-2 text-[#0b1110] font-semibold mb-2 text-sm sm:text-base">
                            <i class="fa-solid fa-check-double text-[#42506a] flex-shrink-0"></i>
                            <span>Konfirmasi Password Baru <span class="text-red-500">*</span></span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="confirm_password"
                                name="confirm_password" 
                                placeholder="Ketik ulang password baru" 
                                class="w-full px-3 sm:px-4 py-2 sm:py-3 pr-10 sm:pr-12 rounded-lg border-2 border-[#a4c6c3] text-sm
                                       focus:outline-none focus:border-[#42506a] text-[#0b1110]
                                       transition-colors"
                                required
                            >
                            <button 
                                type="button" 
                                onclick="togglePassword('confirm_password', this)"
                                class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 text-[#42506a] hover:text-[#0b1110]"
                            >
                                <i class="fa-solid fa-eye text-sm sm:text-base" id="icon-confirm_password"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Security Tips -->
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-3 sm:p-4 rounded">
                        <h4 class="font-semibold text-blue-800 mb-2 flex items-center gap-2 text-sm sm:text-base">
                            <i class="fa-solid fa-shield-halved flex-shrink-0"></i>
                            <span>Tips Keamanan Password Admin:</span>
                        </h4>
                        <ul class="text-xs sm:text-sm text-blue-700 space-y-1 ml-6">
                            <li class="list-disc">Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                            <li class="list-disc">Jangan gunakan informasi pribadi yang mudah ditebak</li>
                            <li class="list-disc">Ubah password secara berkala untuk keamanan maksimal</li>
                            <li class="list-disc">Jangan bagikan password kepada siapapun</li>
                        </ul>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-2 sm:pt-4">
                        <button 
                            type="submit"
                            class="flex-1 px-4 sm:px-6 py-2 sm:py-3 bg-[#42506a] text-white rounded-lg text-sm sm:text-base
                                   hover:bg-[#8086b0] transition duration-300 shadow-lg 
                                   font-semibold flex items-center justify-center gap-2"
                        >
                            <i class="fa-solid fa-save"></i>
                            <span>Simpan Password Baru</span>
                        </button>
                        <a 
                            href="data-pengaduan-admin.php"
                            class="flex-1 px-4 sm:px-6 py-2 sm:py-3 bg-gray-500 text-white rounded-lg text-sm sm:text-base
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

    <script>
        function togglePassword(fieldId, button) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById('icon-' + fieldId);
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>
