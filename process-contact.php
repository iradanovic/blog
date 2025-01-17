<?php
session_start();

// Provjera je li forma poslana
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dohvat i sanitizacija podataka
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validacija unosa
    if (!$name || !$email || !$message) {
        $_SESSION['contact_error'] = 'Sva polja su obavezna.';
    } else {
        // Slanje emaila
        $to = 'your-email@example.com'; // Promijenite na stvarnu email adresu
        $subject = 'Nova poruka s kontakt forme';
        $email_message = "Ime: $name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Poruka:\n$message\n";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";

        // Provjera slanja emaila
        if (mail($to, $subject, $email_message, $headers)) {
            $_SESSION['contact_success'] = 'Vaša poruka je uspješno poslana!';
        } else {
            $_SESSION['contact_error'] = 'Dogodila se pogreška pri slanju poruke. Pokušajte ponovo.';
        }
    }

    // Preusmjeravanje natrag na kontakt stranicu
    header('Location: contact.php');
    exit();
} else {
    // Ako forma nije poslana, preusmjeravanje na početnu stranicu
    header('Location: index.php');
    exit();
}
