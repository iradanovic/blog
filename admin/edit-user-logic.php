<?php
require "config/database.php";

if (isset($_POST['submit'])) {
    // Dohvat podataka iz forme
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Provjera valjanosti unosa
    if (!$firstname || !$lastname) {
        $_SESSION['edit-user'] = "Neispravan unos u formi. Molimo unesite sve podatke.";
    } else {
        // Pripremljeni upit za ažuriranje korisnika
        $query = "UPDATE users SET firstname = ?, lastname = ? WHERE id = ? LIMIT 1";
        $stmt = $connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param('ssi', $firstname, $lastname, $id);
            $result = $stmt->execute();

            if ($result) {
                $_SESSION['edit-user-success'] = "Korisnik $firstname $lastname je uspješno ažuriran.";
            } else {
                $_SESSION['edit-user'] = "Ažuriranje korisnika nije uspjelo.";
            }

            $stmt->close();
        } else {
            $_SESSION['edit-user'] = "Greška prilikom pripreme upita.";
        }
    }
}

// Preusmjeravanje na stranicu za upravljanje korisnicima
header("Location: " . ROOT_URL . "admin/manage-users.php");
exit;
?>
