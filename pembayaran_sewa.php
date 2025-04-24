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

    // Hitung total biaya sewa (misalnya, harga per hari dikali jumlah hari)
    $harga_per_hari = $produk['harga'];
    $total_biaya = $harga_per_hari * $jumlah; // jumlah di sini bisa diartikan sebagai jumlah hari

    // Proses pembayaran (misalnya, simpan ke database atau lakukan transaksi)
    // Simulasi proses pembayaran
    echo "<h1>Pembayaran Sewa</h1>";
    echo "<p>Produk: " . htmlentities($produk['nama_jasa']) . "</p>";
    echo "<p>Total Biaya: " . htmlentities(format_rupiah($total_biaya)) . "</p>";
    echo "<p>Silakan lakukan pembayaran untuk melanjutkan.</p>";
    // Tambahkan logika untuk menyimpan transaksi ke database jika diperlukan
} else {
    echo "Data tidak valid!";
}
?>
