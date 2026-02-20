<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SiFast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

    </style>
    <?php 
    include 'config/koneksi.php';
    $current_page = basename($_SERVER['PHP_SELF']);
    
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND role='$role'");
    $data = mysqli_fetch_assoc($query);
    ?>

</head>

<body class="bg-[#0b1110] overflow-x-hidden">

<div class="flex min-h-screen w-full">

    <!-- SIDEBAR -->
    <div class="w-64 bg-[#ebf3f2] min-h-screen p-6 flex flex-col justify-between shadow-xl">

        <div>
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-10">
                <div class="w-5 h-5 border-2 border-black rotate-45"></div>
                <h1 class="text-2xl font-bold">SiFast</h1>
            </div>

            <!-- User -->
            <div class="mb-8">
                <div class="w-14 h-14 bg-[#42506a] rounded-full mb-3"></div>
                <p class="font-semibold">@<?= $data['username'] ?> (<?= $data['role'] ?>)</p>
                <a href="ubah-password.php"
                   class="text-sm text-gray-600 hover:underline">
                    Ubah Password
                </a>
            </div>

            <hr class="mb-6">

            <!-- Menu -->
            <div class="space-y-4">

                <a href="input-aspirasi.php"
                   class="block p-3 rounded-xl transition
                   <?= $current_page == 'input-aspirasi.php'
                        ? 'bg-[#9bb8b3]'
                        : 'hover:bg-[#cddedb]' ?>">
                    Buat Laporan
                </a>

                <a href="data-pengaduan.php"
                   class="block p-3 rounded-xl transition
                   <?= ($current_page == 'data-pengaduan.php' || $current_page == 'detail-pengaduan.php')
                        ? 'bg-[#9bb8b3]'
                        : 'hover:bg-[#cddedb]' ?>">
                    Data Laporan
                </a>

            </div>
        </div>

        <!-- Logout -->
        <a href="logout.php"
           class="text-center border-2 border-black py-3 rounded-2xl font-semibold
                  hover:bg-red-500 hover:text-white transition">
            LOG OUT
        </a>

    </div>

    <!-- CONTENT -->


</body>
</html>