<?php include('./layouts/header.php') ?>
<?php
session_start();
?>

<title>Hatara Coffee - Aplikasi Rekrutmen & Seleksi Karyawan</title>


<nav class="w-full sticky top-0 bg-white/70 backdrop-blur-md z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex-shrink-0 flex items-center gap-2">
                <div class="w-10 h-10 rounded-full overflow-hidden mx-auto border-2 border-black mb-2">
                    <img src="./assets/img/hatara.jpg" class="w-full h-full object-cover" alt="">
                </div>
                <a href="./" class="text-lg font-semibold text-black">Hatara Coffee</a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-2">
                    <!-- <a href="./" class="text-sm font-medium text-gray-700 hover:text-black px-3 py-2 rounded-md mr-4">Beranda</a> -->
                    <a href="login.php" class="text-sm font-medium text-white bg-black hover:bg-gray-800 px-3 py-2 rounded-md">Masuk</a>
                    <a href="register.php" class="text-sm font-medium text-black bg-gray-100 hover:bg-gray-800 px-3 py-2 rounded-md">Daftar</a>
                </div>
            </div>
        </div>
    </div>

</nav>

<div class="grid grid-cols-2 items-center justify-center px-20 pt-10 gap-20">
    <div class="">
        <h1 class="text-3xl">Selamat Datang di Website Rekrutmen dan Seleksi Penerimaan Karyawan Kedai Kopi Hatara</h1>
        <div class="mt-3"><span class="text-sm">Ingin bergabung dan melamar pekerjaan? <a href="register.php" class="px-5 py-2.5 mt-2 bg-black text-white rounded-md block w-max">Daftar Sekarang</a></span></div>
    </div>
    <img src="./assets/img/kedaikopihatara.jpg" class="rounded-xl" alt="">
</div>

<div class="grid grid-cols-3 gap-5 px-20 mt-10 mb-32">
    <div class="p-7 bg-neutral-100 rounded-md min-h-[40vh] flex flex-col items-center justify-center">
        <h1 class="mb-2 font-bold">1. Masuk</h1>
        <p class="text-center text-sm">Buat akun atau registrasi terlebih dahulu. Jika telah memiliki akun, silakan masuk.</p>
    </div>
    <div class="p-7 bg-neutral-100 rounded-md min-h-[40vh] flex flex-col items-center justify-center">
        <h1 class="mb-2 font-bold">2. Pilih Lowongan Kerja</h1>
        <p class="text-center text-sm">Pilih lowongan kerja yang tersedia sesuai bidang pekerjaan yang ingin dilamar, isi data diri dan lakukan tes seleksi penerimaan kerja</p>

    </div>
    <div class="p-7 bg-neutral-100 rounded-md min-h-[40vh] flex flex-col items-center justify-center">
        <h1 class="mb-2 font-bold">3. Selesai</h1>
        <p class="text-center text-sm">Terima informasi status hasil rekrutmen dan seleksi penerimaan karyawan</p>
    </div>
</div>

<div class="w-full text-center bg-white justify-center py-5 border-t fixed z-50 bottom-0 left-0 right-0 text-sm font-normal text-black/50">
    <span>Copyright &copy; Ahmad Muhtami 2025</span>

</div>








<?php include('./layouts/footer.php') ?>