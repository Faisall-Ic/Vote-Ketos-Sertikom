<?php
include 'koneksi.php'; 


$sql = "SELECT id_admin, password FROM admin";
$result = mysqli_query($koneksi, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id_admin'];
    $plainPassword = $row['password'];

    if (strlen($plainPassword) < 60) {
        $hashed = password_hash($plainPassword, PASSWORD_DEFAULT);


        $update = "UPDATE admin SET password='$hashed' WHERE id_admin='$id'";
        mysqli_query($koneksi, $update);
    }
}

echo "✅ Semua password sudah di-enkripsi.";
?>
