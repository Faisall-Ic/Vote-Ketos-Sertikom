<?php
$page_title = "Edit Calon";
include "koneksi.php";

// Ambil id calon
$id_calon = $_GET['id_calon'];

// Ambil data calon lama
$data_calon_per_id = "SELECT * FROM calon WHERE id_calon = '$id_calon'";
$simpan_edit = mysqli_query($koneksi, $data_calon_per_id);
$ambil_data = mysqli_fetch_assoc($simpan_edit);

$current_page = basename($_SERVER['PHP_SELF']);

if (isset($_POST['simpan'])) {
  $nama = $_POST["nama"];
  $visi = $_POST["visi"];
  $kelas = $_POST["kelas"];
  
  // Cek apakah ada file baru
  if ($_FILES['foto']['name'] != '') {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    // Upload ke folder img/
    move_uploaded_file($tmp, "img/" . $foto);
  } else {
    // Pakai foto lama kalau nggak diganti
    $foto = $ambil_data['foto'];
  }
  
  // Update database
  $update = "UPDATE calon SET nama='$nama', visi='$visi', kelas='$kelas', foto='$foto' WHERE id_calon=$id_calon";
  $simpan = mysqli_query($koneksi, $update);
  
  if ($simpan) {
    header("Location: edit_calon.php?id_calon=$id_calon&success=1");
    exit;
  } else {
    header("Location: edit_calon.php?id_calon=$id_calon&error=1");
    exit;
  }
}
include "header.php";
?>


<div class="w-full px-4 py-6">
  <div class="bg-white shadow-md rounded-lg mb-6">
    <div class="border-b px-6 py-4">
      <h6 class="text-lg font-semibold text-blue-900">Edit Data Calon Ketos</h6>

      <form method="POST" enctype="multipart/form-data" class="mt-4">
        <div class="flex flex-col gap-6">

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" placeholder="Nama" value="<?= $ambil_data['nama'] ?>" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Visi</label>
            <input type="text" name="visi" placeholder="Visi" value="<?= $ambil_data['visi'] ?>" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Kelas</label>
            <input type="text" name="kelas" placeholder="Kelas" value="<?= $ambil_data['kelas'] ?>" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

          <div class="w-full md:w-2/3">
              <label class="block mb-1 text-sm font-medium text-gray-700">Foto Saat Ini</label>
              <div class="flex items-center gap-4">
                <img src="img/<?= $ambil_data['foto'] ?>" alt="Foto Calon" class="w-40 h-50 object-cover rounded-lg border" />
                <div>
                  <label class="block mb-1 text-sm font-medium text-gray-700">Ganti Foto</label>
                  <input type="file" name="foto"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                </div>
              </div>
            </div>


        </div>

        <div class="flex gap-3 mt-6">
          <button type="submit" name="simpan"
            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
            Simpan
          </button>
          <a href="calon.php"
            class="px-6 py-2 bg-gray-400 text-white font-semibold rounded-lg hover:bg-gray-500 transition">
            Batal
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
<script>
  swal({
    title: "Berhasil!",
    text: "Data calon berhasil diperbarui.",
    icon: "success",
    button: "OK"
  }).then(() => {
    window.location.href = "calon.php";
  });
</script>
<?php elseif (isset($_GET['error']) && $_GET['error'] == '1'): ?>
<script>
  swal({
    title: "Gagal!",
    text: "Gagal memperbarui data calon.",
    icon: "error",
    button: "OK"
  });
</script>
<?php endif; ?>

</body>
</html>
