<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SiFast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include __DIR__ . '/../config/koneksi.php';

    // Cegah akses jika belum login
    if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
        header("Location: ../login.php");
        exit;
    }

    $current_page = basename($_SERVER['PHP_SELF']);

    $username = $_SESSION['username'];
    $role     = $_SESSION['role'];

    // Ambil data user
    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM users WHERE username='$username' AND role='$role'"
    );
    $user = mysqli_fetch_assoc($query);

    // Base path supaya aman dipanggil dari folder admin atau user
    $base_path = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) ? '../' : '';
    ?>
</head>

<body class="bg-[#0b1110] overflow-x-hidden">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <div class="w-full md:w-64 bg-[#ebf3f2] min-h-screen p-4 md:p-6 flex flex-col justify-between shadow-lg md:shadow-lg sticky top-0 md:static">

            <div>
                <!-- Logo Area -->
                <div class="flex items-center gap-3 mb-8 pb-5 border-b border-[#a4c6c3]">
                    <div class="w-10 h-10 bg-[#42506a] flex items-center justify-center rounded-lg flex-shrink-0">
                        <i class="fa-solid fa-bolt text-lg text-white"></i>
                    </div>
                    <h1 class="text-xl md:text-2xl font-bold text-[#0b1110]">SiFast</h1>
                </div>

                <!-- User Info -->
                <div class="mb-6 p-4 bg-white rounded-lg border border-[#a4c6c3]">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-[#42506a] rounded-full flex items-center justify-center text-white flex-shrink-0">
                            <i class="fa-solid fa-user text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-[#0b1110] text-xs truncate">
                                @<?= htmlspecialchars($user['username']) ?>
                            </p>
                            <span class="inline-block px-2 py-0.5 text-xs font-medium bg-[#42506a] text-white rounded mt-1">
                                <?= htmlspecialchars(ucfirst($user['role'])) ?>
                            </span>
                        </div>
                    </div>
                    <?php
                    if ($role === 'admin') {
                        $ubah_password_link = $base_path . 'admin/ubah-password.php';
                    } else {
                        $ubah_password_link = $base_path . 'ubah-password.php';
                    }
                    ?>
                    <a href="<?= $ubah_password_link ?>" class="flex items-center gap-2 text-xs text-[#42506a] hover:text-[#0b1110] transition">
                        <i class="fa-solid fa-key text-xs flex-shrink-0"></i> 
                        <span>Ubah Password</span>
                    </a>
                </div>

                <hr class="mb-6 border-[#a4c6c3]">

                <!-- ================= MENU ================= -->
                <nav class="space-y-1">

                    <?php if ($role === 'admin') : ?>

                        <!-- Menu Admin: Data Laporan -->
                        <a href="<?= $base_path ?>admin/data-pengaduan-admin.php"
                            class="flex items-center gap-3 p-3 rounded-lg transition text-sm
                       <?= $current_page == 'data-pengaduan-admin.php'

                            ? 'bg-[#42506a] text-white font-semibold'
                            : 'hover:bg-[#a4c6c3] text-[#0b1110]' ?>">
                            <i class="fa-solid fa-clipboard-list flex-shrink-0"></i>
                            <span class="hidden md:block text-sm">Data Semua Laporan</span>
                            <span class="md:hidden text-sm">Laporan</span>
                        </a>

                        <!-- Menu Admin: Kategori -->
                        <a href="<?= $base_path ?>admin/kategori.php"
                            class="flex items-center gap-3 p-3 rounded-lg transition text-sm
                       <?= $current_page == 'kategori.php'
                            ? 'bg-[#42506a] text-white font-semibold'
                            : 'hover:bg-[#a4c6c3] text-[#0b1110]' ?>">
                            <i class="fa-solid fa-tags flex-shrink-0"></i>
                            <span class="hidden md:block">Kelola Kategori</span>
                            <span class="md:hidden">Kategori</span>
                        </a>

                        <!-- Menu Admin: Akun -->
                        <a href="<?= $base_path ?>admin/daftar-akun.php"
                            class="flex items-center gap-3 p-3 rounded-lg transition text-sm
                       <?= $current_page == 'daftar-akun.php'
                            ? 'bg-[#42506a] text-white font-semibold'
                            : 'hover:bg-[#a4c6c3] text-[#0b1110]' ?>">
                            <i class="fa-solid fa-users-gear flex-shrink-0"></i>
                            <span class="hidden md:block">Kelola Akun</span>
                            <span class="md:hidden">Akun</span>
                        </a>

                    <?php else : ?>

                        <!-- Menu User: Buat Laporan -->
                        <a href="<?= $base_path ?>input-aspirasi.php"
                            class="flex items-center gap-3 p-3 rounded-lg transition text-sm
                       <?= $current_page == 'input-aspirasi.php'
                            ? 'bg-[#42506a] text-white font-semibold'
                            : 'hover:bg-[#a4c6c3] text-[#0b1110]' ?>">
                            <i class="fa-solid fa-pen-to-square flex-shrink-0"></i>
                            <span class="hidden md:block">Buat Laporan</span>
                            <span class="md:hidden">Laporan</span>
                        </a>

                        <!-- Menu User: Data Laporan Saya -->
                        <a href="<?= $base_path ?>data-pengaduan.php"
                            class="flex items-center gap-3 p-3 rounded-lg transition text-sm
                       <?= ($current_page == 'data-pengaduan.php' || $current_page == 'detail-pengaduan.php')
                            ? 'bg-[#42506a] text-white font-semibold'
                            : 'hover:bg-[#a4c6c3] text-[#0b1110]' ?>">
                            <i class="fa-solid fa-folder-open flex-shrink-0"></i>
                            <span class="hidden md:block">Data Laporan Saya</span>
                            <span class="md:hidden">Data Saya</span>
                        </a>

                    <?php endif; ?>

                </nav>
            </div>

            <!-- Logout Button -->
            <div class="mt-6">
                <hr class="mb-4 border-[#a4c6c3]">
                <a href="<?= $base_path ?>logout.php"
                    class="flex items-center justify-center gap-2 py-2 px-3 rounded-lg font-semibold text-sm
                      bg-[#42506a] text-white hover:bg-[#0b1110] transition">
                    <i class="fa-solid fa-right-from-bracket flex-shrink-0"></i>
                    <span class="hidden md:inline">LOG OUT</span>
                    <span class="md:hidden">Exit</span>
                </a>
            </div>

        </div>
        <!-- =========================================== -->


    </div>

</body>

</html>