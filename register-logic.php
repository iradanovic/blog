<?php
require_once "database.php";

// Provjera i pokretanje sesije
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $errors = [];

    // Sanitizacija i validacija unosa
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $password = $_POST['createpassword'] ?? '';
    $confirmPassword = $_POST['confirmpassword'] ?? '';

    // Validacija unosa
    if (!$firstname) $errors[] = "Ime je obavezno.";
    if (!$lastname) $errors[] = "Prezime je obavezno.";
    if (!$username) $errors[] = "Korisničko ime je obavezno.";
    if (strlen($username) < 3) $errors[] = "Korisničko ime mora imati najmanje 3 znaka.";
    if (!ctype_alnum($username)) $errors[] = "Korisničko ime može sadržavati samo slova i brojeve.";
    if (!$email) $errors[] = "Potrebna je valjana email adresa.";
    if (strlen($password) < 8) $errors[] = "Lozinka mora sadržavati najmanje 8 znakova.";
    if ($password !== $confirmPassword) $errors[] = "Lozinke se ne podudaraju.";

    // Provjera ima li grešaka prije nastavka
    if (empty($errors)) {
        // Provjera postoji li korisnik s istim korisničkim imenom ili emailom
        $stmt = $connection->prepare("SELECT 1 FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Korisničko ime ili email već postoje.";
        } else {
            // Hashiranje lozinke
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Unos korisnika u bazu podataka
            $stmt = $connection->prepare(
                "INSERT INTO users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['register-success'] = "Registracija uspješna! Sada se možete prijaviti.";
                header('Location: signin.php');
                exit;
            } else {
                $errors[] = "Došlo je do pogreške prilikom registracije. Pokušajte ponovno kasnije.";
                error_log("Greška baze podataka: " . $stmt->error);
            }
        }
        $stmt->close();
    }

    // Ako ima grešaka, spremite ih u sesiju i vratite korisnika na formu
    if (!empty($errors)) {
        $_SESSION['register-errors'] = $errors;
        $_SESSION['register-data'] = $_POST;
        header('Location: register.php');
        exit;
    }
}
