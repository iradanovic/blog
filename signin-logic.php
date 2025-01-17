<?php
require "database.php";

if (isset($_POST['submit'])) {
    session_start(); // Provjerite je li sesija započeta
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = $_POST['password']; // Bez sanitizacije

    if (!$username_email || !$password) {
        $_SESSION['signin'] = "Invalid username, email, or password.";
    } else {
        // Sigurno dohvaćanje korisnika pomoću pripremljenih izjava
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username_email, $username_email);
        $stmt->execute();
        $fetch_user_result = $stmt->get_result();

        if ($fetch_user_result->num_rows === 1) {
            $user_record = $fetch_user_result->fetch_assoc();
            $db_password = $user_record['password'];

            // Provjera lozinke
            if (password_verify($password, $db_password)) {
                // Postavljanje sesije
                $_SESSION['user-id'] = $user_record['id'];
                $_SESSION['signin-success'] = "User successfully logged in";

                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }

                // Preusmjeravanje korisnika
                header('location: ' . ROOT_URL . 'admin/index.php');
                die();
            } else {
                $_SESSION['signin'] = "Invalid username, email, or password.";
            }
        } else {
            $_SESSION['signin'] = "Invalid username, email, or password.";
        }
    }

    // Ako je bilo problema, vrati se na stranicu za prijavu
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = ['username_email' => $username_email];
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
