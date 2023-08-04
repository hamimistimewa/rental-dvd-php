<!DOCTYPE html>
<html>
<head>
    <title>Edit Data DVD</title>
    <style>
        /* CSS sama seperti pada add.php */
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        h1 {
            color: #0066cc;
        }
        form {
            width: 300px;
            margin: 20px 0;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        input[type="submit"],
        a {
            background-color: #0066cc;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover,
        a:hover {
            background-color: #0052a3;
        }
    </style>
</head>
<body>
    <?php
    // Koneksi ke database
    $conn = mysqli_connect("localhost", "root", "", "rental_dvd");
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Cek apakah ID disediakan melalui URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Ambil data DVD berdasarkan ID dari database
        $query = "SELECT * FROM dvds WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);

        // Jika data DVD tidak ditemukan, kembalikan ke halaman index.php
        if (!$data) {
            header("Location: index.php");
            exit();
        }

        // Proses form edit jika ada data yang dikirimkan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $judul = $_POST['judul'];
            $genre = $_POST['genre'];
            $stok = $_POST['stok'];

            // Update data DVD ke database
            $query_update = "UPDATE dvds SET judul = '$judul', genre = '$genre', stok = '$stok' WHERE id = $id";
            if (mysqli_query($conn, $query_update)) {
                // Redirect kembali ke halaman index.php setelah proses edit selesai
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $query_update . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        // Jika ID tidak disediakan, kembali ke halaman index.php
        header("Location: index.php");
        exit();
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
    ?>

    <h1>Edit Data DVD</h1>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <label>Judul:</label>
        <input type="text" name="judul" value="<?php echo $data['judul']; ?>" required>
        <label>Genre:</label>
        <input type="text" name="genre" value="<?php echo $data['genre']; ?>" required>
        <label>Stok:</label>
        <input type="number" name="stok" value="<?php echo $data['stok']; ?>" required>
        <input type="submit" value="Simpan">
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
