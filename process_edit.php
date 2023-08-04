<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "rental_dvd");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $stok = $_POST['stok'];

    // Update data DVD ke database
    $query = "UPDATE dvds SET judul = '$judul', genre = '$genre', stok = '$stok' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        // Jika data berhasil diubah, kembalikan ke halaman index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
