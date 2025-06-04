<?php
include "auth.php";
$page_title = "Dashboard";

include "header.php";
include "koneksi.php";
$current_page = basename($_SERVER['PHP_SELF']);

// Ambil data calon dan jumlah voting masing-masing
$query = "SELECT calon.* , COUNT(voting.id_calon) AS total_suara 
          FROM calon 
          LEFT JOIN voting ON calon.id_calon = voting.id_calon 
          GROUP BY calon.id_calon";

$hasil = mysqli_query($koneksi, $query);
$calon = mysqli_fetch_all($hasil, MYSQLI_ASSOC);

// Total suara masuk
$total_semua = 0;
foreach ($calon as $c) {
    $total_semua += $c['total_suara'];
}

// Total admin
$admin_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total_admin FROM admin");
$total_admin = mysqli_fetch_assoc($admin_result)['total_admin'];

// Total calon ketua
$total_calon = count($calon);

// Pemenang sementara
$pemenang = '';
$suara_tertinggi = -1;
foreach ($calon as $c) {
    if ($c['total_suara'] > $suara_tertinggi) {
        $suara_tertinggi = $c['total_suara'];
        $pemenang = $c['nama'];
    }
}


$limit = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) as total FROM voting";
$total_result = mysqli_query($koneksi, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

$sql_detail = "SELECT v.id_voting, c.nama AS nama_calon, v.waktu, v.nisn
               FROM voting v
               LEFT JOIN calon c ON v.id_calon = c.id_calon
               ORDER BY v.id_voting ASC
               LIMIT $limit OFFSET $offset";
$hasil_detail = mysqli_query($koneksi, $sql_detail);
?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="buat-tailwind.css">
  </head>
  <body>
    <div class="w-full flex">
      <!-- Statistik Dashboard -->
       <div class="">
        <div class="flex gap-4 px-6 mt-6">
          <div class="w-70 flex flex-col justify-center items-center gap-y-2 bg-blue-900 text-white p-6 rounded-2xl shadow-xl">
            <p class="text-sm">Total Suara Masuk</p>
            <p class="text-6xl font-semibold"><?= $total_semua ?></p>
          </div>
          <div class="w-70 flex flex-col justify-center items-center gap-y-2 bg-gray-900 text-white p-6 rounded-2xl shadow-xl">
            <p class="text-sm">Total Akun Admin</p>
            <p class="text-6xl font-semibold"><?= $total_admin ?></p>
          </div>
        </div>
        <div class="flex gap-4 px-6 mt-6">
          <div class="w-70 flex flex-col justify-center items-center gap-y-2 bg-gray-900 text-white p-6 rounded-2xl shadow-xl">
            <p class="text-sm">Total Calon Ketua</p>
            <p class="text-6xl font-semibold"><?= $total_calon ?></p>
          </div>
          <div class="w-70 flex flex-col justify-center items-center gap-y-2 bg-blue-900 text-white p-6 rounded-2xl shadow-xl">
            <p class="text-sm">Pemenang Sementara</p>
            <p class="text-3xl font-semibold"><?= $pemenang ?></p>
          </div>
        </div>
       </div>

      <!-- Chart Progress Suara -->
      <div class="w-full px-6 mt-10">
        <div class="bg-white rounded-2xl shadow-xl p-6">
          <h2 class="text-xl font-semibold mb-4">Progress Voting</h2>
          <?php foreach ($calon as $c): 
            $persen = $total_semua > 0 ? round(($c['total_suara'] / $total_semua) * 100) : 0;
          ?>
            <div class="mb-4">
              <div class="flex justify-between text-sm mb-1">
                <span class="font-medium text-gray-700"><?= $c['nama'] ?></span>
                <span class="text-gray-500"><?= $persen ?>%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-900 h-3 rounded-full" style="width: <?= $persen ?>%"></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- Card Calon -->
    <div class="w-full flex flex-wrap gap-10 justify-center items-start mt-20">
      <?php
      $no = 1;
      foreach ($calon as $data) {
      ?>
        <div class="mt-30 max-w-80 min-h-140 bg-white border border-gray-200 rounded-3xl shadow-xl dark:bg-gray-800 dark:border-gray-700 relative">
          <!-- Point di atas card -->
          <div class="absolute -mt-37
           bg-white px-35 py-5 rounded-xl shadow-xl text-center">
            <p class="text-lg text-gray-500">Point</p>
            <p class="text-6xl font-bold text-blue-900"><?= $data['total_suara'] ?></p>
          </div>
          <a href="#" class="shadow-xl">
              <img class="rounded-t-3xl w-100 shadow-xl" src="img/<?= $data['foto'] ?>" alt="" />
          </a>
          <div class="ps-5 pb-5 pe-5 pt-10">
              <div class="flex mb-2">
                  <h1 class="absolute mt-28 ms-44 text-gray-500 text-8xl opacity-30 font-semibold">0<?= $no++ ?></h1>
                  <a href="#">
                      <h5 class="-mt-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $data['nama']?></h5>
                  </a>
              </div>
              <p class="mb-3 min-h-30 max-w-58 tracking-wider text-sm text-gray-600 dark:text-gray-400"><?="  -  "?><?= $data['visi'] ?></p>
              <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-900 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  Visi dan Misi
                  <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                  </svg>
              </a>
          </div>
        </div>
      <?php } ?>
    </div>
    
    <div class="bg-white rounded-lg shadow mt-6">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
      <h6 class="text-lg font-semibold text-gray-700">Laporan Detail Voting</h6>
    </div>

    <div class="px-0 pt-0 pb-2">
      <div class="overflow-x-auto p-0">
        <div class="overflow-y-auto max-h-96">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Voter</th>
                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">NISN</th>
                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Nama Calon</th>
                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Waktu Voting</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
              <?php
              if (!$hasil_detail || mysqli_num_rows($hasil_detail) == 0) {
                  echo "<tr><td colspan='4' class='text-center py-4 text-gray-500'>Belum ada data voting.</td></tr>";
              } else {
                  while ($row = mysqli_fetch_assoc($hasil_detail)) {
              ?>
              <tr>
                <td class="text-center px-4 py-2"><?= $row['id_voting'] ?></td>
                <td class="text-center px-4 py-2"><?= htmlspecialchars($row['nisn']) ?></td>
                <td class="text-center px-4 py-2"><?= htmlspecialchars($row['nama_calon']) ?></td>
                <td class="text-center px-4 py-2"><?= date("d-m-Y H:i:s", strtotime($row['waktu'])) ?></td>
              </tr>
              <?php
                  }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="mt-4 flex justify-center space-x-2">
        <?php if ($page > 1) { ?>
          <a href="?page=<?= $page - 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Prev</a>
        <?php } ?>

        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
          <a href="?page=<?= $i ?>" class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-900 text-white' : 'bg-gray-200 hover:bg-gray-300' ?>"><?= $i ?></a>
        <?php } ?>

        <?php if ($page < $total_pages) { ?>
          <a href="?page=<?= $page + 1 ?>" class="px-3 py-1 bg-gray-300 rounded hover:bg-gray-400">Next</a>
        <?php } ?>
      </div>
    </div>
</div>
  </div>

  </body>
</html>