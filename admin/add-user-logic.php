<?php
require "config/database.php";

if (isset($_POST["submit"])) {
    // Sanitizacija podataka
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Provjera unosa
    if (!$firstname) {
        $_SESSION['add-user'] = 'Unesite svoje ime.';
    } elseif (!$lastname) {
        $_SESSION['add-user'] = 'Unesite svoje prezime.';
    } elseif (!$username) {
        $_SESSION['add-user'] = 'Unesite korisničko ime.';
    } elseif (!$email) {
        $_SESSION['add-user'] = 'Unesite valjanu email adresu.';
    } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION['add-user'] = 'Lozinka mora imati najmanje 8 znakova.';
    } elseif ($createpassword !== $confirmpassword) {
        $_SESSION['add-user'] = 'Lozinke se ne podudaraju.';
    } else {
        // Provjera jedinstvenosti korisničkog imena ili emaila
        $user_check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $connection->prepare($user_check_query);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['add-user'] = "Korisničko ime ili email već postoji.";
        } else {
            // Hashiranje lozinke
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
        }
    }

    // Povratak na formu ako postoje greške
    if (isset($_SESSION['add-user'])) {
        $_SESSION['add-user-data'] = $_POST;
        header('Location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        // Unos korisnika u bazu
        $insert_user_query = "INSERT INTO users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($insert_user_query);
        $stmt->bind_param('sssss', $firstname, $lastname, $username, $email, $hashed_password);
        $stmt->execute();

        if (!$stmt->errno) {
            $_SESSION['add-user-success'] = 'Registracija uspješna.';
            header('Location: ' . ROOT_URL . 'admin/manage-users.php');
            die();
        } else {
            $_SESSION['add-user'] = 'Greška prilikom registracije.';
            header('Location: ' . ROOT_URL . 'admin/add-user.php');
            die();
        }
    }
} else {
    // Ako gumb nije kliknut
    header('Location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
