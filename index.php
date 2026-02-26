<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiFast - Sistem Informasi Fasilitas Sarana & Prasarana</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#0b1110] min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full">
        
        <!-- Logo Area -->
        <div class="flex items-center justify-center gap-3 mb-12">
            <div class="w-16 h-16 bg-[#42506a] flex items-center justify-center rounded-2xl shadow-lg">
                <i class="fa-solid fa-bolt text-3xl text-white"></i>
            </div>
            <h1 class="text-5xl font-bold text-[#ebf3f2]">SiFast</h1>
        </div>

        <!-- Main Card -->
        <div class="bg-[#ebf3f2] rounded-3xl shadow-2xl p-12 text-center">
            
            <!-- Welcome Title -->
            <h2 class="text-4xl font-bold text-[#0b1110] mb-4">
                Selamat Datang di SiFast
            </h2>
            
            <!-- Subtitle -->
            <p class="text-lg text-[#42506a] mb-8">
                Aplikasi pengaduan sapras SMK Mutu
            </p>

            <!-- Divider -->
            <div class="w-24 h-1 bg-[#42506a] mx-auto mb-8 rounded-full"></div>

            <!-- CTA Text -->
            <p class="text-xl text-[#0b1110] font-medium mb-8">
                Mulai Lapor
            </p>

            <!-- Login Button -->
            <a href="login.php" 
               class="inline-block px-12 py-4 bg-[#42506a] text-white text-lg font-semibold 
                      rounded-xl hover:bg-[#0b1110] transition duration-300 shadow-lg
                      transform hover:scale-105">
                LOGIN
            </a>

        </div>

        <!-- Footer Info -->
        <div class="text-center mt-8 text-gray-400 text-sm">
            <p>© 2026 SiFast - Sistem Informasi Fasilitas</p>
        </div>

    </div>

</body>
</html>
