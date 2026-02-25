<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SiFast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
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

    <div class="flex min-h-screen ">

        <!-- ================= SIDEBAR ================= -->
            <div class="w-64 bg-[#ebf3f2] min-h-screen p-6 flex flex-col justify-between shadow-xl">

            <div>
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-5 h-5 border-2 border-black rotate-45"></div>
                    <h1 class="text-2xl font-bold">SiFast</h1>
                </div>

                <!-- User Info -->
                <div class="mb-8">
                    <div class="w-14 h-14 bg-[#42506a] rounded-full mb-3"></div>
                    <p class="font-semibold">
                        @<?= htmlspecialchars($user['username']) ?>
                        (<?= htmlspecialchars($user['role']) ?>)
                    </p>
                    <a href="<?= $base_path ?>ubah-password.php"
                        class="text-sm text-gray-600 hover:underline">
                        Ubah Password
                    </a>
                </div>

                <hr class="mb-6">

                <!-- ================= MENU ================= -->
                <div class="space-y-4">

                    <?php if ($role === 'admin') : ?>

                        <a href="<?= $base_path ?>admin/data-pengaduan-admin.php"
                            class="block p-3 rounded-xl transition
                       <?= $current_page == 'data-pengaduan-admin.php'
                            ? 'bg-[#9bb8b3]'
                            : 'hover:bg-[#cddedb]' ?>">
                            Data Semua Laporan
                        </a>

                        <a href="<?= $base_path ?>admin/kategori.php"
                            class="block p-3 rounded-xl transition
                       <?= $current_page == 'kategori.php'
                            ? 'bg-[#9bb8b3]'
                            : 'hover:bg-[#cddedb]' ?>">
                            Kelola Kategori
                        </a>

                        <a href="<?= $base_path ?>admin/daftar-akun.php"
                            class="block p-3 rounded-xl transition
                       <?= $current_page == 'daftar-akun.php'
                            ? 'bg-[#9bb8b3]'
                            : 'hover:bg-[#cddedb]' ?>">
                            Kelola Akun
                        </a>

                    <?php else : ?>

                        <a href="<?= $base_path ?>input-aspirasi.php"
                            class="block p-3 rounded-xl transition
                       <?= $current_page == 'input-aspirasi.php'
                            ? 'bg-[#9bb8b3]'
                            : 'hover:bg-[#cddedb]' ?>">
                            Buat Laporan
                        </a>

                        <a href="<?= $base_path ?>data-pengaduan.php"
                            class="block p-3 rounded-xl transition
                       <?= ($current_page == 'data-pengaduan.php' || $current_page == 'detail-pengaduan.php')
                            ? 'bg-[#9bb8b3]'
                            : 'hover:bg-[#cddedb]' ?>">
                            Data Laporan Saya
                        </a>

                    <?php endif; ?>

                </div>
            </div>

            <!-- Logout -->
            <a href="<?= $base_path ?>logout.php"
                class="text-center border-2 border-black py-3 rounded-2xl font-semibold
                  hover:bg-red-500 hover:text-white transition">
                LOG OUT
            </a>

        </div>
        <!-- =========================================== -->


    </div>

</body>

</html>