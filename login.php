<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tailwind v3 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-[#0b1110]">

    <div class="w-[400px] p-6 rounded-xl shadow-2xl bg-[#ebf3f2]">
        
        <h2 class="text-2xl font-bold text-center text-[#0b1110] mb-6 font-semibold">
            Masuk
        </h2>

        <form action="proses-login.php" method="POST" class="space-y-5">

            <div>
                <label class="block text-sm font-medium text-[#42506a] mb-1">
                    Username / NIS
                </label>
                <input 
                    placeholder="Masukkan Username/NIS"
                    type="text" 
                    name="username"
                    class="w-full px-4 py-2 rounded-lg border border-[#a4c6c3] 
                           focus:outline-none focus:ring-2 focus:ring-[#8086b0] 
                           focus:border-[#8086b0] bg-white"
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-[#42506a] mb-1">
                    Password
                </label>
                <input 
                    placeholder="Masukkan password"
                    type="password" 
                    name="password"
                    class="w-full px-4 py-2 rounded-lg border border-[#a4c6c3] 
                           focus:outline-none focus:ring-2 focus:ring-[#8086b0] 
                           focus:border-[#8086b0] bg-white"
                    required
                >
            </div>

            <button 
                type="submit" 
                name="login"
                class="w-full py-2 rounded-lg font-semibold text-white 
                       bg-[#42506a] hover:bg-[#0b1110] 
                       transition duration-300 shadow-md"
            >
                LOGIN
            </button>

        </form>

    </div>

</body>
</html>