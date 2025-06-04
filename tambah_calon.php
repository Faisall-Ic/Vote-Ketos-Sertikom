<?php
$page_title = "Tambah Calon";
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST["nama"];
    $visi = $_POST["visi"];
    $kelas = $_POST["kelas"];
    

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $target_dir = "img/";
    

    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0755, true);
    }
    

    $upload = move_uploaded_file($tmp, $target_dir . $foto);
    
    if ($upload) {
      $sql = "INSERT INTO calon (nama, visi, kelas, foto) VALUES ('$nama', '$visi', '$kelas', '$foto')";
      $simpan = mysqli_query($koneksi, $sql);
      
      if ($simpan) {
        header("Location: tambah_calon.php?success=1");
        exit;
      } else {
        header("Location: tambah_calon.php?error=1");
        exit;
      }
    } else {
      header("Location: tambah_calon.php?error=2");
      exit;
    }
  }
  include "header.php";
?>

<div class="w-full px-4 py-6">
  <div class="bg-white shadow-md rounded-lg mb-6">
    <div class="border-b px-6 py-4">
      <h6 class="text-lg font-semibold text-blue-900">Tambah Data Calon Ketos</h6>

      <form method="post" enctype="multipart/form-data" class="mt-4">
        <div class="flex flex-col gap-6">

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" required placeholder="Nama"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Visi</label>
            <input type="text" name="visi" required placeholder="Visi"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Kelas</label>
            <input type="text" name="kelas" required placeholder="Kelas"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>
          
          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="foto" accept="image/*" required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

        </div>

        <button type="submit"
          class="mt-6 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
          Simpan
        </button>
      </form>
    </div>
  </div>
</div>

<!-- SweetAlert CDN -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- SweetAlert Trigger -->
<?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
  <script>
    swal({
      title: "Berhasil!",
      text: "Data calon berhasil ditambahkan.",
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
      text: "Gagal menyimpan data ke database.",
      icon: "error",
      button: "OK"
    });
  </script>
<?php elseif (isset($_GET['error']) && $_GET['error'] == '2'): ?>
  <script>
    swal({
      title: "Gagal!",
      text: "Upload foto gagal. Coba lagi.",
      icon: "error",
      button: "OK"
    });
  </script>
<?php endif; ?>

</body>
</html>
