<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "rental_dvd");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $stok = $_POST['stok'];

    // Masukkan data ke database
    $query = "INSERT INTO dvds (judul, genre, stok) VALUES ('$judul', '$genre', '$stok')";
    if (mysqli_query($conn, $query)) {
        // Jika data berhasil ditambahkan, kembalikan ke halaman index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
