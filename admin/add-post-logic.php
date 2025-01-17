<?php
require "config/database.php";

// Postavljanje UTF-8 za bazu podataka
mysqli_set_charset($connection, 'utf8mb4');
header('Content-Type: text/html; charset=utf-8');

if (isset($_POST['submit'])) {
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $body = htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8');
    $thumbnail = $_FILES['thumbnail'];

    if (!$title) {
        $_SESSION['add-post'] = "Unesite naslov posta.";
    } elseif (!$body) {
        $_SESSION['add-post'] = "Unesite sadržaj posta.";
    } elseif (!$thumbnail['name']) {
        $_SESSION['add-post'] = "Odaberite sliku za thumbnail.";
    } else {
        $time = time();
        $thumbnail_name = $time . '-' . $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = "../images/" . $thumbnail_name;

        $allowed_extensions = ['jpg', 'png', 'jpeg'];
        $extension = strtolower(pathinfo($thumbnail_name, PATHINFO_EXTENSION));

        if (in_array($extension, $allowed_extensions)) {
            if ($thumbnail['size'] <= 2 * 1024 * 1024) {
                if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)) {
                    $query = "INSERT INTO posts (title, body, thumbnail) VALUES (?, ?, ?)";
                    $stmt = $connection->prepare($query);
                    $stmt->bind_param('sss', $title, $body, $thumbnail_name);

                    if ($stmt->execute()) {
                        $_SESSION['add-post-success'] = "Post je uspješno dodan.";
                        header("location: " . ROOT_URL . 'admin/index.php');
                        die();
                    } else {
                        $_SESSION['add-post'] = "Dodavanje posta nije uspjelo.";
                    }
                } else {
                    $_SESSION['add-post'] = "Dogodila se pogreška pri prijenosu slike.";
                }
            } else {
                $_SESSION['add-post'] = "Veličina slike ne smije biti veća od 2 MB.";
            }
        } else {
            $_SESSION['add-post'] = "Slika mora biti u formatu JPG, JPEG ili PNG.";
        }
    }

    if (isset($_SESSION['add-post'])) {
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    }
}

header("location: " . ROOT_URL . 'admin/index.php');
die();
?>
