<?php
// input_sampah.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = date('Y-m-d H:i:s');

    // Handle file upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = 'uploads/';
        $image = $upload_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'dbsi'); // Replace 'db_name' with your database name

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO sampah (name, description, image, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $description, $image, $created_at);

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
    <title>Input Sampah</title>
    <link rel="stylesheet" href="../css/styleA.css">
</head>
<body>
<h1>Admin Input Pages</h1>
    <nav>
        <ul>
            <li><a href="artikel.php">Input Edukasi</a></li>
            <li><a href="gambar.php">Input Gambar</a></li>
            <li>
                <a href="#">Input Sampah</a>
                <ul class="dropdown">
                    <li><a href="admin/b_sampah.php">Sampah Bahaya</a></li>
                    <li><a href="admin/m_sampah.php">Manfaat Sampah</a></li>
                    <li><a href="admin/p_sampah.php">Pengolahan Sampah</a></li>
                </ul>
            </li>
            <!--<li><a href="input_users.php">Input Users</a></li>-->
        </ul>
    </nav>
    <h1>Input Sampah</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image"><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
<style>
    /* Basic styles for navigation */
    nav ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    nav ul li {
        position: relative;
        margin-right: 20px;
    }

    nav ul li a {
        text-decoration: none;
        padding: 10px 15px;
        background-color: #007BFF;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    nav ul li a:hover {
        background-color: #0056b3;
    }

    /* Dropdown menu styles */
    .dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        z-index: 1;
    }

    .dropdown li {
        margin: 0;
    }

    .dropdown li a {
        padding: 10px 20px;
        display: block;
        color: #333;
        background-color: transparent;
    }

    .dropdown li a:hover {
        background-color: #f1f1f1;
    }

    nav ul li:hover .dropdown {
        display: block;
    }
</style>