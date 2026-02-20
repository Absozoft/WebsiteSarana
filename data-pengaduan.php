<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SiFast - Data Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <?php
    session_start();

    // Cegah akses jika belum login
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    include 'config/koneksi.php';

    $user_id = $_SESSION['user_id'];
    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM pengaduan WHERE user_id = '$user_id'"
    );
    
    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }
    
    ?>
</head>

<body class="bg-[#0b1110]">

    <div class="flex min-h-screen">

        <!-- ================= SIDEBAR ================= -->
        <?php include 'partial/sidebar.php'; ?>
        <!-- =========================================== -->

        <!-- ================= CONTENT ================= -->
        <div class="flex-1 p-10 text-white">

            <h2 class="text-3xl font-bold mb-6">
                Data Pengaduan Saya
            </h2>

            <div class="bg-[#ebf3f2] rounded-2xl shadow-2xl overflow-hidden">

                <table class="w-full text-sm text-left text-[#0b1110]">
                    <thead class="bg-[#42506a] text-white">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Judul</th>
                            <th class="px-6 py-3">Deskripsi</th>
                            <th class="px-6 py-3">Lokasi</th>
                            <th class="px-6 py-3">Kategori</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($query) > 0): ?>
                            <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                                <tr class="border-b hover:bg-[#a4c6c3] transition duration-200">

                                    <td class="px-6 py-4">
                                        <?= $data["user_id"] ?>
                                    </td>

                                    <td class="px-6 py-4 font-semibold">
                                        <?= $data["judul"] ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?= $data["deskripsi"] ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?= $data["lokasi"] ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?= $data["kategori_id"] ?>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a href="detail-pengaduan.php?id=<?= $data['id'] ?>"
                                            class="px-4 py-2 bg-[#42506a] text-white rounded-lg
                                          hover:bg-[#0b1110] transition duration-300 shadow-md">
                                            Detail
                                        </a>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Belum ada pengaduan.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>

        </div>
        <!-- =========================================== -->

    </div>

</body>

</html>