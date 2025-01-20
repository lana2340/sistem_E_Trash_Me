<?php
// input_sampah_bahaya.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deskripsi = $_POST['deskripsi'];

    // Handle file upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = realpath(__DIR__ . '../../uploads/'); // Path folder uploads di luar direktori proyek
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Amankan nama file
        $file_name = basename($_FILES['image']['name']);
        $file_name = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file_name); // Hapus karakter berbahaya
        $target_file = $upload_dir . DIRECTORY_SEPARATOR . $file_name;

        // Validasi file hanya gambar
        $file_type = mime_content_type($_FILES['image']['tmp_name']);
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file_type, $allowed_types)) {
            die("Error: File bukan gambar yang valid. Hanya JPG, PNG, atau GIF yang diperbolehkan.");
        }

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = $file_name; // Simpan nama file ke database
        } else {
            die("Error: Gagal mengunggah file.");
        }
    }

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'dbsi'); // Ganti 'dbsi' dengan nama database Anda

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO sampah_bahaya (image, deskripsi) VALUES (?, ?)");
    $stmt->bind_param("ss", $image, $deskripsi);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Sampah Bahaya</title>
    <link rel="stylesheet" href="../css/styleA.css">
</head>
<body>
    <h1>Input Sampah Bahaya</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">Upload Gambar:</label>
        <input type="file" id="image" name="image" required><br>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" cols="30" required></textarea><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
