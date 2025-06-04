<?php
include "auth.php";
$page_title = "Calon Ketua Osis";

include "header.php";
include "koneksi.php";

$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="container mx-auto px-4 py-6">
  <div class="w-full">
    <div class="bg-white shadow-md rounded-lg mb-6">
      <div class="px-6 py-4 border-b">
        <a
          class="inline-block px-6 py-2 font-bold text-center text-white uppercase bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-lg shadow-md hover:scale-105 active:opacity-85 transition"
          href="tambah_calon.php">+ Tambah</a>
        <h6 class="font-semibold text-blue-900 mt-4">Calon Ketua Osis</h6>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
          <thead>
            <tr class="bg-gray-100 text-gray-500 uppercase text-xs">
              <th class="text-center px-4 py-3">No</th>
              <th class="px-4 py-3">Nama</th>
              <th class="text-center px-4 py-3">Visi</th>
              <th class="text-center px-4 py-3">Kelas</th>
              <th class="text-center px-4 py-3">Foto</th>
              <th class="text-center px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y">
            <?php
            $no = 1;
            $sql = "select * from calon order by id_calon DESC";
            $hasil = mysqli_query($koneksi, $sql);
            foreach ($hasil as $data) {
            ?>
              <tr class="bg-gray-50 font-semibold text-md text-gray-900">
                <td class="text-center px-4 py-3"><?= $no++ ?></td>
                <td class="px-4 py-3"><?= $data['nama'] ?></td>
                <td class="text-center px-4 py-3 max-w-70"><?= $data['visi'] ?></td>
                <td class="text-center px-4 py-3"><?= $data['kelas'] ?></td>
                <td class="text-center px-4 py-3"><img class="w-40 m-auto rounded-xl" src="img/<?= $data['foto'] ?>" alt=""></td>
                <td class="text-center px-4 py-3 space-x-2">
                  <a href="edit_calon.php?id_calon=<?= $data['id_calon'] ?>" class="mr-3 inline-block px-6 py-3 font-bold text-center bg-gradient-to-tl from-green-600 to-lime-400 uppercase align-middle transition-all rounded-lg cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-white">Edit</a>
                  <a href="#" 
                    class="btn-hapus inline-block px-6 py-3 font-bold uppercase text-center bg-gradient-to-tl text-xs from-red-600 to-rose-400 rounded-lg text-white"
                    data-id="<?= $data['id_calon'] ?>" 
                    data-nama="<?= $data['nama'] ?>">Hapus
                  </a>
                </td>
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

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Seleksi semua tombol dengan class .btn-hapus
  const hapusButtons = document.querySelectorAll('.btn-hapus');

  hapusButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.getAttribute('data-id');
      const nama = this.getAttribute('data-nama');

      swal({
        title: "Yakin ingin menghapus?",
        text: `Data calon dengan nama "${nama}" akan dihapus!`,
        icon: "warning",
        buttons: ["Batal", "Hapus"],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          window.location.href = `hapus_calon.php?id_calon=${id}`;
        }
      });
    });
  });
});
</script>

</body>
</html>