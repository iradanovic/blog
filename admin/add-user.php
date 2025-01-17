<?php
include "partials/header.php";

// Dohvati prethodno unesene podatke ako je došlo do greške prilikom registracije
$firstname = htmlspecialchars($_SESSION['add-user-data']['firstname'] ?? '', ENT_QUOTES, 'UTF-8');
$lastname = htmlspecialchars($_SESSION['add-user-data']['lastname'] ?? '', ENT_QUOTES, 'UTF-8');
$username = htmlspecialchars($_SESSION['add-user-data']['username'] ?? '', ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_SESSION['add-user-data']['email'] ?? '', ENT_QUOTES, 'UTF-8');

// Očisti sesiju nakon dohvaćanja podataka
unset($_SESSION['add-user-data']);
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Dodaj Korisnika</h2>

        <!-- Prikaz poruka o uspjehu ili greškama -->
        <?php if (isset($_SESSION['add-user-success'])): ?>
            <div class="alert_message success">
                <p><?= htmlspecialchars($_SESSION['add-user-success'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php unset($_SESSION['add-user-success']); ?>
            </div>
        <?php elseif (isset($_SESSION['add-user'])): ?>
            <div class="alert_message error">
                <p><?= htmlspecialchars($_SESSION['add-user'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php unset($_SESSION['add-user']); ?>
            </div>
        <?php endif; ?>

        <!-- Forma za dodavanje korisnika -->
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="Ime" required>
            <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Prezime" required>
            <input type="text" name="username" value="<?= $username ?>" placeholder="Korisničko ime" required>
            <input type="email" name="email" value="<?= $email ?>" placeholder="Email" required>
            <input type="password" name="createpassword" placeholder="Lozinka" required>
            <input type="password" name="confirmpassword" placeholder="Potvrdi lozinku" required>
            <button type="submit" name="submit" class="btn">Dodaj Korisnika</button>
        </form>
    </div>
</section>

<?php
include '../templates/footer.php';
?>
