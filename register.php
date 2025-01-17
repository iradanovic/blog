<?php

include 'templates/header.php';

//get beck form DATA IF THERE IS A REGISTRATION ERROR
$firstname=$_SESSION['register-data']['firstname'] ?? null;
$lastname=$_SESSION['register-data']['lastname'] ?? null;
$username=$_SESSION['register-data']['username'] ?? null;
$email=$_SESSION['register-data']['email'] ?? null;
$createpassword=$_SESSION['register-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['register-data']['confirmpassword'] ?? null;


//delete register data session
unset($_SESSION['register-data']);
?>
<section class="form_section">
    <div class="container form_section-container">
        <h2>Registracija</h2>

        <!-- Globalna poruka o grešci -->
        <?php if (isset($_SESSION['register-errors'])): ?>
            <div class="alert_message error">
                <ul>
                    <?php foreach ($_SESSION['register-errors'] as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php unset($_SESSION['register-errors']); ?>
            </div>
        <?php endif; ?>


        <!-- Forma za registraciju -->
        <form action="<?= ROOT_URL ?>register-logic.php" method="POST">
            
            <!-- Ime -->
            <label for="firstname">Ime:</label>
            <input 
                type="text" 
                id="firstname" 
                name="firstname" 
                value="<?= htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8'); ?>" 
                placeholder="Unesite vaše ime" 
                required 
                minlength="2" 
                aria-describedby="firstname-error">
            <?php if (isset($errors['firstname'])): ?>
                <small id="firstname-error" class="error_message"><?= $errors['firstname'] ?></small>
            <?php endif; ?>

            <!-- Prezime -->
            <label for="lastname">Prezime:</label>
            <input 
                type="text" 
                id="lastname" 
                name="lastname" 
                value="<?= htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8'); ?>" 
                placeholder="Unesite vaše prezime" 
                required 
                minlength="2" 
                aria-describedby="lastname-error">
            <?php if (isset($errors['lastname'])): ?>
                <small id="lastname-error" class="error_message"><?= $errors['lastname'] ?></small>
            <?php endif; ?>

            <!-- Korisničko ime -->
            <label for="username">Korisničko ime:</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>" 
                placeholder="Unesite korisničko ime" 
                required 
                minlength="3" 
                aria-describedby="username-error">
            <?php if (isset($errors['username'])): ?>
                <small id="username-error" class="error_message"><?= $errors['username'] ?></small>
            <?php endif; ?>

            <!-- Email -->
            <label for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" 
                placeholder="Unesite vašu email adresu" 
                required 
                aria-describedby="email-error">
            <?php if (isset($errors['email'])): ?>
                <small id="email-error" class="error_message"><?= $errors['email'] ?></small>
            <?php endif; ?>

            <!-- Lozinka -->
            <label for="createpassword">Lozinka:</label>
            <input 
                type="password" 
                id="createpassword" 
                name="createpassword" 
                placeholder="Unesite lozinku" 
                required 
                pattern=".{8,}" 
                title="Lozinka mora sadržavati najmanje 8 znakova." 
                aria-describedby="password-error">
            <?php if (isset($errors['password'])): ?>
                <small id="password-error" class="error_message"><?= $errors['password'] ?></small>
            <?php endif; ?>

            <!-- Potvrda lozinke -->
            <label for="confirmpassword">Potvrdite lozinku:</label>
            <input 
                type="password" 
                id="confirmpassword" 
                name="confirmpassword" 
                placeholder="Ponovno unesite lozinku" 
                required 
                aria-describedby="confirm-password-error">
            <?php if (isset($errors['confirmPassword'])): ?>
                <small id="confirm-password-error" class="error_message"><?= $errors['confirmPassword'] ?></small>
            <?php endif; ?>

            <!-- Gumb za slanje -->
            <button type="submit" name="submit" class="btn">Registracija</button>
            <small>Već imate račun? <a href="signin.php">Prijavite se</a></small>
        </form>
    </div>
</section>
</body>
</html>
