<?php
// input_pengolahan_sampah.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $artikel = $_POST['artikel'];

    // Handle file upload
    $gambar = null;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $gambar = $upload_dir . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
    }

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'dbsi'); // Replace 'db_name' with your database name

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO pengolahan_sampah (gambar, artikel) VALUES (?, ?)");
    $stmt->bind_param("ss", $gambar, $artikel);

    if ($stmt->execute()) {
        echo "Data successfully inserted!";
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
    <title>Input Pengolahan Sampah</title>
    <link rel="stylesheet" href="../css/styleA.css">
</head>
<body>
    <h1>Input Pengolahan Sampah</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="gambar">Upload Gambar:</label>
        <input type="file" id="gambar" name="gambar" required><br>

        <label for="artikel">Artikel:</label>
        <textarea id="artikel" name="artikel" rows="10" cols="30" required></textarea><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
