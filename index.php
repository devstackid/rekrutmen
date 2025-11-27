<?php include('./layouts/header.php') ?>
<?php 
      session_start();
?>

<title>Login</title>



<div class="w-full h-screen overflow-hidden grid lg:grid-cols-3 grid-cols-1 p-0">
  <div class="flex items-center h-screen justify-center z-30">
    <div>
      <h1 class="text-center text-3xl font-black text-blue-700">Login
        <span class="block text-xs font-normal text-black">Harap masuk untuk melanjutkan</span>
      </h1>

      <?php
      if (isset($_SESSION['result'])) {
        if ($_SESSION['result'] != 'success') {
      ?>
          <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-300 max-w-[300px] mx-auto mt-5" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <div>
              <span class="font-medium">Maaf!</span> <?= $_SESSION['message'] ?>
            </div>
          </div>

      <?php
        }
        unset($_SESSION['result']);
        unset($_SESSION['message']);
      }
      ?>



      <form class="mt-8" action="config/login_proses.php" method="POST">
        <div class="mb-5">
          <label for="username" class="block mb-2 text-xs font-medium text-gray-900">Username</label>
          <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="mb-5">
          <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
          <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg placeholder:text-xs focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>
        <div class="grid grid-cols-3 gap-1">
          <button type="submit" class="col-span-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs w-full sm:w-auto px-5 py-2.5 text-center">Masuk</button>
         

        </div>
      </form>
    </div>
  </div>
  <div class="absolute inset-0 z-20 lg:hidden z-[21] bg-gradient-to-tr from-white/50 to-blue-500/50 backdrop-blur-sm">

  </div>
  <div class="h-full lg:col-span-2 lg:flex absolute inset-0 lg:relative z-20">
    <img src="/assets/img/kedai.JPG" class="object-cover h-full" alt="">
  </div>
</div>

<div class="w-full text-center justify-center py-5 border-t text-sm font-normal text-black/50">
<span>Copyright &copy; Ahmad Muhtami 2025</span>

</div>








<?php include('./layouts/footer.php') ?>