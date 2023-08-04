<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "rental_dvd");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data dari database
$query = "DELETE FROM dvds WHERE id = $id";
if (mysqli_query($conn, $query)) {
    // Jika data berhasil dihapus, kembalikan ke halaman index.php
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
