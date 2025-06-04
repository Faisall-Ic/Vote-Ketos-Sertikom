<?php
$page_title = "Edit Admin";
include "koneksi.php";

// Ambil id
$id_admin = $_GET['id_admin'];

// Query data admin
$data_admin_per_id = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$simpan_edit = mysqli_query($koneksi, $data_admin_per_id);
$ambil_data = mysqli_fetch_assoc($simpan_edit);

$current_page = basename($_SERVER['PHP_SELF']);

// Handle update
if (isset($_POST['simpan'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nama_lengkap = $_POST['nama_lengkap'];
  
  $update = "UPDATE admin SET username='$username', password='$password', nama_lengkap='$nama_lengkap' WHERE id_admin=$id_admin";
  $simpan = mysqli_query($koneksi, $update);
  
  if ($simpan) {
    header("Location: edit_admin.php?id_admin=$id_admin&success=1");
    exit;
  } else {
    header("Location: edit_admin.php?id_admin=$id_admin&error=1");
    exit;
  }
}
include "header.php";
?>

<div class="w-full px-4 py-6">
  <div class="bg-white shadow-md rounded-lg mb-6">
    <div class="border-b px-6 py-4">
      <h6 class="text-lg font-semibold text-blue-900">Edit Data Admin</h6>

      <form method="POST" class="mt-4">
        <div class="flex flex-col gap-6">

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" placeholder="Username" value="<?= $ambil_data['username'] ?>"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
            <input type="text" name="password" placeholder="Password" value="<?= $ambil_data['password'] ?>"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

          <div class="w-full md:w-2/3">
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= $ambil_data['nama_lengkap'] ?>"
              required
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
          </div>

        </div>

        <div class="flex gap-3 mt-6">
          <button type="submit" name="simpan"
            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
            Simpan
          </button>
          <a href="admin.php"
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
    text: "Data admin berhasil diperbarui.",
    icon: "success",
    button: "OK"
  }).then(() => {
    window.location.href = "admin.php";
  });
</script>
<?php elseif (isset($_GET['error']) && $_GET['error'] == '1'): ?>
<script>
  swal({
    title: "Gagal!",
    text: "Gagal memperbarui data admin.",
    icon: "error",
    button: "OK"
  });
</script>
<?php endif; ?>

</body>
</html>
