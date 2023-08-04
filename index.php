<!DOCTYPE html>
<html>
<head>
    <title>Rental DVD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        h1 {
            color: #0066cc;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            background-color: #0066cc;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0052a3;
        }
    </style>
</head>
<body>
    <h1>Rental DVD</h1>
    <a href="add.php">Tambah Data</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Genre</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Koneksi ke database
        $conn = mysqli_connect("localhost", "root", "", "rental_dvd");
        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        // Ambil data dari database
        $query = "SELECT * FROM dvds";
        $result = mysqli_query($conn, $query);

        // Tampilkan data dalam tabel
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['stok'] . "</td>";
            echo "<td><a href='delete.php?id=" . $row['id'] . "'>Hapus</a></td>";
            echo "</tr>";
        }

        // Tutup koneksi ke database
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
