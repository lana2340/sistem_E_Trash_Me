<?php
// input_edukasi.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_at = date('Y-m-d H:i:s');

    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Path ke folder uploads
        $upload_dir = __DIR__ . '/../uploads/'; // Path absolut ke folder uploads
        
        // Pastikan folder ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Nama file unik untuk menghindari konflik
        $image_name = uniqid('img_') . '_' . basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;

        // Upload file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = $image_name; // Hanya menyimpan nama file ke database
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
    }

    // Simpan data ke database
    $conn = new mysqli('localhost', 'root', '', 'dbsi'); // Ganti 'dbsi' dengan nama database Anda

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO edukasi (title, content, image, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $image, $created_at);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Kesalahan: " . $stmt->error;
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
    <title>Input Edukasi</title>
    <link rel="stylesheet" href="../css/styleA.css">
</head>
<body>
    <h1>Input Edukasi</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea><br>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
