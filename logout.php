<?php
// Uključi datoteku s konfiguracijom baze podataka
require 'database.php';

// Pokreni sesiju ako već nije započeta
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Brisanje svih podataka iz sesije
session_unset();

// Uništavanje sesije
session_destroy();

// Preusmjeravanje korisnika na početnu stranicu ili login
header('Location: ' . ROOT_URL);
exit;
?>
