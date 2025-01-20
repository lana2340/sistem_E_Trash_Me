<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'dbsi'); // Ganti 'dbsi' dengan nama database Anda

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID artikel dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mengambil data artikel berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM manfaat_sampah WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Artikel tidak ditemukan.";
    exit;
}

$artikel = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars("Artikel #{$artikel['id']}"); ?></title>
    <style>
        /* CSS untuk detail artikel */
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

        .image {
            text-align: center;
            margin-bottom: 20px;
        }

        .image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .content {
            line-height: 1.6;
            text-align: justify;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
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
        <h1>Artikel #<?php echo $artikel['id']; ?></h1>
        <div class="image">
            <?php if (!empty($artikel['gambar'])): ?>
                <img src="<?php echo htmlspecialchars($artikel['gambar']); ?>" alt="Gambar">
            <?php endif; ?>
        </div>
        <div class="content">
            <p><?php echo nl2br(htmlspecialchars($artikel['artikel'])); ?></p>
        </div>
        <a href="manfaat.php" class="back-link">Kembali</a>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Manfaat Sampah. All Rights Reserved.
    </footer>
</body>
</html>
