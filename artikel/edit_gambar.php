<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'dbsi'); // Ganti 'dbsi' dengan nama database Anda

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data gambar berdasarkan ID
$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM gambar WHERE id = $id");

if ($result->num_rows == 0) {
    die("Data tidak ditemukan.");
}

$row = $result->fetch_assoc();
$old_image = $row['image']; // Simpan nama gambar lama

// Update data gambar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $image = $old_image; // Default ke gambar lama

    // Cek apakah ada gambar baru yang diunggah
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Path ke folder uploads
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Nama file unik untuk gambar baru
        $image_name = uniqid('img_') . '_' . basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;

        // Upload file baru
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $image = $image_name;

            // Hapus gambar lama jika ada
            if (!empty($old_image) && file_exists($upload_dir . $old_image)) {
                unlink($upload_dir . $old_image);
            }
        } else {
            echo "Gagal mengunggah gambar baru.";
            exit;
        }
    }

    // Update data di database
    $stmt = $conn->prepare("UPDATE gambar SET description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssi", $description, $image, $id);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui data.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gambar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            color: #007BFF;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], textarea, input[type="file"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Gambar</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea><br>

        <label for="image">Current Image:</label><br>
        <?php if (!empty($row['image'])): ?>
            <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Image" style="width: 100px; height: auto;"><br>
        <?php else: ?>
            No Image<br>
        <?php endif; ?>

        <label for="image">Upload New Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
