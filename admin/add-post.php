<?php
include "partials/header.php";

// Dohvat prethodno unesenih podataka iz sesije, ako forma nije bila valjana
$title = $_SESSION['add-post-data']['title'] ?? '';
$body = $_SESSION['add-post-data']['body'] ?? '';
unset($_SESSION['add-post-data']);
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Dodaj Post</h2>
        
        <!-- Prikaz poruka o greškama -->
        <?php if (isset($_SESSION['add-post'])): ?>
            <div class="alert_message error">
                <p>
                    <?= htmlspecialchars($_SESSION['add-post'], ENT_QUOTES, 'UTF-8'); ?>
                    <?php unset($_SESSION['add-post']); ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- Forma za dodavanje posta -->
        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
            <!-- Naslov -->
            <input 
                type="text" 
                name="title" 
                value="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" 
                placeholder="Naslov" 
                required>
            
            <!-- Tekst posta -->
            <textarea 
                rows="8" 
                name="body" 
                placeholder="Sadržaj" 
                required><?= htmlspecialchars($body, ENT_QUOTES, 'UTF-8'); ?></textarea>

            <!-- Dodavanje thumbnaila -->
            <div class="form_control">
                <label for="thumbnail">Dodaj thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
            </div>

            <!-- Gumb za dodavanje -->
            <button type="submit" name="submit" class="btn">Dodaj Post</button>
        </form>
    </div>
</section>

<?php
include '../templates/footer.php';
?>
