<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-mocca { background-color: #6F4E37; }
    </style>
</head>
<body class="bg-black text-white">
    <header class="bg-black py-4 text-center text-xl font-bold">
        <nav class="container mx-auto flex justify-between items-center px-6">
            <div class="text-mocca text-2xl font-bold">Coffee Shop</div>
            <div>
            </div>
            <div>
                <a href="{{ route('login') }}" class="bg-transparent border border-mocca text-mocca px-4 py-2 rounded-lg hover:bg-mocca hover:text-mocca">Login</a>
                <a href="{{ route('register') }}" class="bg-mocca text-black px-4 py-2 rounded-lg ml-2 hover:bg-opacity-80">Register</a>
            </div>
        </nav>
    </header>
    
    <!-- Landing Page Section -->
    <section class="relative container mx-auto mt-6 px-4 text-center bg-gradient-to-b from-black to-gray-900 shadow-lg p-12 rounded-lg min-h-screen flex flex-col justify-center">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('img/devin-avery-B3u-SJbCy0U-unsplash.jpg'); opacity: 0.3;"></div>
        <div class="relative z-10">
            <h2 class="text-4xl font-semibold text-mocca">Selamat Datang di Afifan Coffee</h2>
            <p class="mt-4 text-lg">Nikmati berbagai varian kopi terbaik dengan cita rasa istimewa.</p>
        </div>
    </section>
    
    <!-- About Section -->
    <section id="about" class="container mx-auto mt-12 px-4 bg-gradient-to-b from-gray-900 to-black shadow-lg p-6 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div>
                <img src="img/natallia-sorenkova-JQO_e30zRjw-unsplash.jpg" alt="About Coffee Shop" class="rounded-lg shadow-lg w-full">
            </div>
            <div>
                <h2 class="text-3xl font-semibold text-mocca">Tentang Kami</h2>
                <p class="mt-4 text-lg">Coffee Shop kami berdedikasi untuk menyajikan kopi berkualitas tinggi dengan biji kopi pilihan dari berbagai daerah.</p>
                <p class="mt-2 text-lg">Kami percaya bahwa setiap cangkir kopi memiliki cerita, dan kami ingin berbagi cerita itu dengan Anda.</p>
            </div>
        </div>
    </section>
    
    <footer class="bg-black text-center py-4 mt-10">
        &copy; 2025 Coffee Shop. All Rights Reserved.
    </footer>
</body>
</html>
