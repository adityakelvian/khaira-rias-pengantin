<?php
session_start();
include('includes/config.php');

if(isset($_GET['id']) && isset($_GET['jumlah'])) {
    $id = $_GET['id'];
    $jumlah = $_GET['jumlah'];

    // Ambil informasi produk dari database
    $sql = "SELECT * FROM wedding_org WHERE id_jasa='$id'";
    $query = mysqli_query($koneksidb, $sql);
    $produk = mysqli_fetch_array($query);

    // Hitung total biaya beli (misalnya, harga dikali jumlah produk)
    $harga_per_unit = $produk['harga'];
    $total_biaya = $harga_per_unit * $jumlah; // jumlah di sini adalah jumlah produk yang dibeli

    // Proses pembayaran (misalnya, simpan ke database atau lakukan transaksi)
    // Simulasi proses pembayaran
    echo "<h1>Pembayaran Beli</h1>";
    echo "<p>Produk: " . htmlentities($produk['nama_jasa']) . "</p>";
    echo "<p>Total Biaya: " . htmlentities(format_rupiah($total_biaya)) . "</p>";
    echo "<p>Silakan lakukan pembayaran untuk melanjutkan.</p>";
    // Tambahkan logika untuk menyimpan transaksi ke database jika diperlukan
} else {
    echo "Data tidak valid!";
}
?>
