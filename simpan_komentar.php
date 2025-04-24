<?php
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_jasa = intval($_POST['id_jasa']);
    $username = mysqli_real_escape_string($koneksidb, $_POST['username']);
    $komentar = mysqli_real_escape_string($koneksidb, $_POST['komentar']);
    $tanggal = date('Y-m-d H:i:s');

    // Simpan komentar ke database tanpa gambar
    $sql = "INSERT INTO komentar (id_jasa, username, komentar, tanggal) VALUES ('$id_jasa', '$username', '$komentar', '$tanggal')";
    mysqli_query($koneksidb, $sql);
    
    header("Location: wo_details.php?id=$id_jasa");
    exit();
}
?>