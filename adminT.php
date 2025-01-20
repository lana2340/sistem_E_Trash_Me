<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Input Pages</title>
    <link rel="stylesheet" href="css/styleA.css">
</head>
<body>
    <h1>Admin Input Pages</h1>
    <nav>
        <ul>
            <li><a href="artikel/artikel.php">Input Edukasi</a></li>
            <li><a href="artikel/gambar.php">Input Gambar</a></li>
            <li>
                <a href="#">Input Sampah</a>
                <ul class="dropdown">
                    <li><a href="admin/b_sampah.php">Sampah Bahaya</a></li>
                    <li><a href="admin/m_sampah.php">Manfaat Sampah</a></li>
                    <li><a href="admin/p_sampah.php">Pengolahan Sampah</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Manage Post</a>
                <ul class="dropdown">
                    <li><a href="artikel/hapus_artik.php">Edukasi</a></li>
                    <li><a href="artikel/hapus_gambar.php">Manfaat Sampah</a></li>
                    <li><a href="admin/p_sampah.php">Pengolahan Sampah</a></li>
                </ul>
            </li>
            
        </ul>
    </nav>
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
