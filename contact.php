<?php 
include 'templates/header.php';

// Prikaz poruke o statusu forme
if (isset($_SESSION['contact_success'])) {
    $message = $_SESSION['contact_success'];
    $message_type = 'success';
    unset($_SESSION['contact_success']);
} elseif (isset($_SESSION['contact_error'])) {
    $message = $_SESSION['contact_error'];
    $message_type = 'error';
    unset($_SESSION['contact_error']);
}
?>
<section class="contact_page section_extra-margin form_section">
    <div class="container form_section-container">
        <!-- Naslov sekcije -->
        <h2>Kontaktirajte Nas</h2>

        <!-- Prikaz statusne poruke -->
        <?php if (!empty($message)): ?>
            <div class="alert_message <?= $message_type ?>">
                <p><?= htmlspecialchars($message) ?></p>
            </div>
        <?php endif; ?>

        <!-- Kontakt Forma -->
        <div class="contact_form">
            <form action="process-contact.php" method="POST">
                <div class="form_control">
                    <label for="name">Vaše ime:</label>
                    <input type="text" id="name" name="name" placeholder="Unesite vaše ime" required>
                </div>
                <div class="form_control">
                    <label for="email">Vaš email:</label>
                    <input type="email" id="email" name="email" placeholder="Unesite vaš email" required>
                </div>
                <div class="form_control">
                    <label for="message">Poruka:</label>
                    <textarea id="message" name="message" rows="5" placeholder="Napišite vašu poruku" required></textarea>
                </div>
                <button type="submit" class="btn">Pošalji</button>
            </form>
        </div>

        <!-- Google Karta -->
        <div class="google_map">
            <h2>Naša lokacija</h2>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093176!2d144.95373541550445!3d-37.81627944202161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5772f8f4b763d6a!2sFederation%20Square%2C%20Melbourne%20VIC%203001%2C%20Australia!5e0!3m2!1sen!2shr!4v1611275038498!5m2!1sen!2shr" 
                width="100%" 
                height="400" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<?php
include 'templates/footer.php';
?>
