<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <title>Osis Smk Pesat Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="buat-tailwind.css">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="./assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />    
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    
    <style>
        .active{
            background-color: rgb(19, 19, 104);
            padding: 3px 0px 3px 3px;
            border-radius: 10px;
            font-weight: 600;
        }
        svg{
          width: 20px;
          height: 20px;
        }
        .active svg{
          color: black;
          width: 25px;
          height: 25px;
        }
        .active span{
            color: white;
        }
    </style>

</head>

  <body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <!-- sidenav  -->
    <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
      <div class="h-19.5">
        <a class="block px-8 py-6 text-sm whitespace-nowrap text-slate-700" href="javascript:;" target="_blank">
          <img src="img/logo.jpg" class="inline h-15 w-15 transition-all duration-200 ease-nav-brand" alt="main_logo" />
          <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Osis Dashboard</span>
        </a>
      </div>

      <hr class="h-px mt-5 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

      <div class="mt-3 items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors nav-link <?= $current_page == 'dashboard_admin.php' ? 'active' : '' ?>" href="dashboard_admin.php">
              <div class="shadow-soft-2xl mr-2 flex items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 20v-6M12 20v-12M18 20v-10" />
                </svg>


              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors nav-link <?= $current_page == 'admin.php' ? 'active' : '' ?>" href="admin.php">
              <div class="shadow-soft-2xl mr-2 flex items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 016 16h12a4 4 0 01.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                </svg>

              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Admin</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors nav-link <?= $current_page == 'calon.php' ? 'active' : '' ?>" href="calon.php">
              <div class="shadow-soft-2xl mr-2 flex items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 11-8 0 4 4 0 018 0zM4 11a4 4 0 118 0 4 4 0 01-8 0z" />
                </svg>

              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Calon Ketua Osis</span>
            </a>
          </li>

          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors nav-link <?= $current_page == 'laporan.php' ? 'active' : '' ?>" href="laporan.php">
              <div class="shadow-soft-2xl mr-2 flex items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h6M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>

              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Laporan</span>
            </a>
          </li>

          
          <li class="mt-0.5 w-full">
            <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors nav-link <?= $current_page == 'index.php' ? 'active' : '' ?>" href="index.php">
              <div class="shadow-soft-2xl mr-2 flex  items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M4 6h16M4 6v12a2 2 0 002 2h12a2 2 0 002-2V6" />
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Vote Disini</span>
            </a>
          </li>

          
      
    </aside>

    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
      <!-- Navbar -->
      <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
          <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
              <li class="text-sm leading-normal">
                <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
              </li>
              <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">
                <?= isset($page_title) ? htmlspecialchars($page_title) : 'Dashboard' ?>
              </li>
            </ol>
            <h6 class="mb-0 font-bold capitalize">
              <?= isset($page_title) ? htmlspecialchars($page_title) : 'Dashboard' ?>
            </h6>
          </nav>

          <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <div class="flex items-center md:ml-auto md:pr-4">
              <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
              </div>
            </div>
            <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
              <li class="flex items-center px-3 bg-blue-300 rounded-lg">
                <?php if (isset($_SESSION['nama_lengkap'])): ?>
                  <span class="block px-0 py-2 text-sm font-semibold text-slate-700">
                    <i class="fa fa-user sm:mr-1"></i>
                    <span class="hidden sm:inline"><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></span>
                  </span>
                <?php else: ?>
                  <a href="login.php" class="block px-0 py-2 text-md font-semibold transition-all ease-nav-brand text-gray-700">
                    <i class="fa fa-user sm:mr-1"></i>
                    <span class="hidden sm:inline">Sign In</span>
                  </a>
                <?php endif; ?>
              </li>
              <li class="flex items-center ms-3 px-3 bg-red-400 rounded-lg">
                  <a href="logout.php" class="flex items-center text-sm font-semibold text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>
                    Logout
                  </a>
              </li>
              <li class="flex items-center pl-4 xl:hidden">
                <a href="javascript:;" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500" sidenav-trigger>
                  <div class="w-4.5 overflow-hidden">
                    <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                    <i class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                    <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- end Navbar -->
    </div>
  </body>
  <!-- plugin for charts  -->
  <script src="./assets/js/plugins/chartjs.min.js" async></script>
  <!-- plugin for scrollbar  -->
  <script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- main script file  -->
  <script src="./assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5" async></script>
</html>
