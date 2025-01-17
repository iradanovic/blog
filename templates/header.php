<?php
require 'database.php';
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogsy</title>
    <link rel="stylesheet" href="<?=ROOT_URL?>css/style.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
</head> 
<body>
    <nav>
        <div class="container nav_container">
            <a href="<?=ROOT_URL?>index.php" class="nav_logo">Blogsy</a>
            <ul class="nav_items">
                <li><a href="<?=ROOT_URL?>index.php">Početna</a></li>
                <li><a href="<?=ROOT_URL?>blog.php">Blog</a></li>
                <li><a href="<?=ROOT_URL?>about.php">O nama</a></li>
                <li><a href="<?=ROOT_URL?>contact.php">Kontakt</a></li>
                <?php if (isset($_SESSION['user-id'])) : ?>
                    <li><a href="<?=ROOT_URL?>admin/index.php">Dashboard</a></li>
                    <li><a href="<?=ROOT_URL?>logout.php">Odjava</a></li>
                <?php else : ?>
                    <li><a href="<?=ROOT_URL?>signin.php">Prijava</a></li>
                    <li><a href="<?=ROOT_URL?>register.php">Registracija</a></li>
                <?php endif ?>
            </ul>
            <button id="open_nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close_nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>

