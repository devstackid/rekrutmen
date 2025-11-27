<!-- <nav class="fixed lg:relative lg:bg-white lg:h-[40vh] top-0 left-0 right-0 z-50 border-gray-200 ">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="/assets/img/hatara.jpg" class="h-8 w-8 rounded-full border-2 ring-2 ring-blue-700 shadow" alt="Logo" />
        <span class="self-center text-xl font-normal whitespace-nowrap" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Hatara</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto " id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 bg-white md:bg-transparent border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
        <li><a href="/" class="text-sm font-normal md:text-black text-black hover:text-blue-700 transition">Beranda</a></li>
        <li><a href="#membership" class="text-sm font-normal md:text-black text-black hover:text-blue-700 transition">Membership</a></li>
        <li><a href="#katalog" class="text-sm font-normal md:text-black text-black hover:text-blue-700 transition">Katalog</a></li>
        <li><a href="#event" class="text-sm font-normal md:text-black text-black hover:text-blue-700 transition">Event</a></li>
        <li class="mt-3 md:mt-0"><a href="/login.php" class="text-sm font-normal px-5 py-2 rounded text-white bg-black transition">Login</a></li>
      </ul>
    </div>
  </div>
</nav> -->


<nav class="lg:h-[35vh] bg-white flex items-center justify-center py-4 px-5 lg:py-10 lg:px-10 relative lg:max-w-full overflow-x-hidden">
  <a href="/login.php" class="text-sm font-normal px-5 py-2 text-white bg-black transition absolute top-3 right-3 lg:hidden">Login</a>

  <div class="flex flex-nowrap flex-col lg:flex-row lg:gap-5 lg:justify-center items-start w-full">
    <a href="/" class="flex items-center lg:space-x-3 rtl:space-x-reverse lg:mr-10 gap-3 lg:gap-0">
      <img src="/assets/img/hatara.jpg" class="lg:w-32 lg:h-32 w-8 h-8 rounded-full border-2 ring-2 ring-black shadow" alt="Logo" />
      <h1 class="lg:hidden text-sm font-bold text-black">Hatara</h1>
    </a>
    <div class="mt-5 overflow-hidden border-t pt-2 lg:border-none lg:pt-0">
      <div class="flex w-full lg:w-auto lg:justify-end justify-start items-center lg:gap-20 lg:mb-12">
        <h1 class="text-sm lg:text-5xl font-medium text-black lg:mr-16 hidden lg:flex">HATARA COFFEE</h1>
        <a href="/login.php" class="text-sm font-normal px-10 py-2 text-white bg-black transition hidden lg:flex">Login</a>
      </div>
      <ul class="font-medium flex flex-row space-x-8 max-w-[340px] lg:max-w-full pb-2 lg:pb-0 pr-10 lg:pr-0 overflow-x-auto">
        <li><a href="/" class="text-sm lg:text-base uppercase font-bold md:text-black text-black hover:text-blue-700 transition">Beranda</a></li>
        <li><a href="/review.php" class="text-sm lg:text-base uppercase font-bold md:text-black text-black hover:text-blue-700 transition">Ulasan</a></li>
        <li><a href="/membership.php" class="text-sm lg:text-base uppercase font-bold md:text-black text-black hover:text-blue-700 transition">Membership</a></li>
        <li><a href="/menu.php" class="text-sm lg:text-base uppercase font-bold md:text-black text-black hover:text-blue-700 transition">Katalog</a></li>
        <li><a href="/event.php" class="text-sm lg:text-base uppercase font-bold md:text-black text-black hover:text-blue-700 transition">Event</a></li>
        <li><a href="/lokasi.php" class="text-sm lg:text-base uppercase font-bold md:text-black text-black hover:text-blue-700 transition">Lokasi</a></li>
        <li><a href="/kontak.php" class="text-sm lg:text-base uppercase font-bold md:text-black text-black hover:text-blue-700 transition">Kontak</a></li>
      </ul>
    </div>
  </div>
</nav>