<?php
include "auth.php";
$page_title = "Laporan";

include "header.php";
include "koneksi.php";

$current_page = basename($_SERVER['PHP_SELF']);

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


<div class="container mx-auto py-4">
  <div class="grid grid-cols-1">
    <div class="w-full">
      <div class="bg-white rounded-lg shadow mb-4">

        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
          <h6 class="text-lg font-semibold text-gray-700">Laporan Perolehan Voting Ketua OSIS</h6>
        </div>

        <div class="px-0 pt-0 pb-2">
          <div class="overflow-x-auto p-0">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">No</th>
                  <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Nama Calon</th>
                  <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Kelas</th>
                  <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Foto</th>
                  <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Visi</th>
                  <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-2">Jumlah Suara</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-100">
              <?php
                $no = 1;
                $sql = "SELECT c.id_calon, c.nama, c.kelas, c.foto, c.visi, COUNT(v.id_calon) AS jumlah_suara
                        FROM calon c
                        LEFT JOIN voting v ON c.id_calon = v.id_calon
                        GROUP BY c.id_calon";

                $hasil = mysqli_query($koneksi, $sql);
                $total_suara = 0;

                if (!$hasil || mysqli_num_rows($hasil) == 0) {
                    echo "<tr><td colspan='5' class='text-center py-4 text-gray-500'>Belum ada data voting.</td></tr>";
                } else {
                    foreach ($hasil as $row) {
                        $total_suara += $row['jumlah_suara'];
              ?>
                <tr>
                  <td class="text-center px-4 py-2"><?= $no++ ?></td>
                  <td class="text-center px-4 py-2"><?= htmlspecialchars($row['nama']) ?></td>
                  <td class="text-center px-4 py-2"><?= htmlspecialchars($row['kelas']) ?></td>
                  <td class="text-center px-4 py-2"><img src="img/<?= htmlspecialchars($row['foto']) ?>" alt="Foto Calon" class="w-40 m-auto rounded-xl"></td>
                  <td class="text-center px-4 py-2 w-100"><?= htmlspecialchars($row['visi']) ?></td>
                  <td class="text-center px-4 py-2"><?= $row['jumlah_suara'] ?></td>
                </tr>
              <?php
                    }
              ?>
                <tr class="bg-gray-100">
                  <td colspan="5" class="text-center px-4 py-2 text-lg tracking-wider font-bold">Total Seluruh Suara</td>
                  <td class="text-center px-4 py-2 text-lg tracking-wider font-bold"><?= $total_suara ?></td>
                </tr>
              <?php
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
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
