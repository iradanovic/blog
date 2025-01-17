<?php
include "partials/header.php";

// Provjera i validacija ID-a
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Dohvaćanje korisnika iz baze
    $query = "SELECT firstname, lastname FROM users WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['edit-user-error'] = "Korisnik nije pronađen.";
        header('Location: ' . ROOT_URL . 'admin/manage-users.php');
        die();
    }
} else {
    $_SESSION['edit-user-error'] = "Neispravan ID korisnika.";
    header('Location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Uredi Korisnika</h2>

        <!-- Forma za uređivanje korisnika -->
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="POST">
            <!-- Skriveni ID -->
            <input type="hidden" value="<?= $id ?>" name="id">

            <!-- Ime i prezime -->
            <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Ime" required>
            <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="Prezime" required>

            <!-- Gumb za ažuriranje -->
            <button type="submit" name="submit" class="btn">Ažuriraj Korisnika</button>
        </form>
    </div>
</section>

<?php
include "../templates/footer.php";
?>
