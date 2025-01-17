<?php
include 'templates/header.php';

// Dohvaćanje podataka iz sesije u slučaju greške
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

// Brisanje podataka iz sesije
unset($_SESSION['signin-data']);
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Prijava</h2>

        <!-- Poruke o uspjehu ili grešci -->
        <?php if (isset($_SESSION['signup-success'])): ?>
            <div class="alert_message success">
                <p>
                    <?= htmlspecialchars($_SESSION['signup-success'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php unset($_SESSION['signup-success']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['signin'])): ?>
            <div class="alert_message error">
                <p>
                    <?= htmlspecialchars($_SESSION['signin'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php unset($_SESSION['signin']); ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- Forma za prijavu -->
        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
            <!-- Korisničko ime ili email -->
            <label for="username_email">Korisničko ime ili Email:</label>
            <input 
                type="text" 
                id="username_email" 
                name="username_email" 
                value="<?= htmlspecialchars($username_email, ENT_QUOTES, 'UTF-8') ?>" 
                placeholder="Unesite korisničko ime ili email" 
                required>

            <!-- Lozinka -->
            <label for="password">Lozinka:</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                value="<?= htmlspecialchars($password, ENT_QUOTES, 'UTF-8') ?>" 
                placeholder="Unesite lozinku" 
                required>

            <!-- Gumb za prijavu -->
            <button type="submit" class="btn" name="submit">Prijava</button>
            <small>Nemate korisnički račun? <a href="register.php">Registrirajte se</a></small>
        </form>
    </div>
</section>
</body>
</html>
