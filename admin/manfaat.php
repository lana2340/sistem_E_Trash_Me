<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'dbsi'); // Ganti 'dbsi' dengan nama database Anda

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data dari tabel manfaat_sampah
$result = $conn->query("SELECT * FROM manfaat_sampah ORDER BY id DESC");

if ($result->num_rows == 0) {
    echo "Tidak ada data yang tersedia.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manfaat Sampah</title>
    <style>
        /* CSS untuk tampilan blog */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #007BFF;
        }

        .post {
            margin-bottom: 30px;
        }

        .post img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 5px;
        }

        .post h2 {
            margin: 15px 0 10px;
            font-size: 24px;
            color: #007BFF;
        }

        .post p {
            line-height: 1.6;
            text-align: justify;
        }

        .read-more {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .read-more:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manfaat Sampah</h1>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="post">
                <?php if (!empty($row['gambar'])): ?>
                    <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar">
                <?php endif; ?>
                <h2>Artikel #<?php echo $row['id']; ?></h2>
                <p><?php echo nl2br(htmlspecialchars(substr($row['artikel'], 0, 200))); ?>...</p>
                <a href="detail_artikel.php?id=<?php echo $row['id']; ?>" class="read-more">Baca Selengkapnya</a>
            </div>
        <?php endwhile; ?>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Manfaat Sampah. All Rights Reserved.
    </footer>
</body>
</html>

<?php
$conn->close();
?>
