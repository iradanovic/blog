<?php
include "partials/header.php";

// Provjera je li ID postavljen i valjan
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Dohvat podataka o postu iz baze
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } else {
        // Preusmjeravanje ili prikaz greške ako post ne postoji
        $_SESSION['edit-post'] = "Post ne postoji.";
        header('Location: ' . ROOT_URL . 'admin/');
        exit();
    }
} else {
    // Preusmjeravanje ili prikaz greške ako ID nije valjan
    $_SESSION['edit-post'] = "Neispravan ID posta.";
    header('Location: ' . ROOT_URL . 'admin/');
    exit();
}
?>

<section class="form_section">
    <div class="container form_section-container">
        <h2>Uredi Post</h2>
        <?php if (isset($_SESSION['edit-post'])): ?>
            <div class="alert_message error">
                <?= $_SESSION['edit-post']; unset($_SESSION['edit-post']); ?>
            </div>
        <?php endif; ?>
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <!-- Naslov -->
            <input type="text" value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>" name="title" placeholder="Naslov" required>
            
            <!-- Skriveni podaci -->
            <input type="hidden" value="<?= $post['id']; ?>" name="id">
            <input type="hidden" value="<?= htmlspecialchars($post['thumbnail'], ENT_QUOTES, 'UTF-8'); ?>" name="previous_thumbnail_name">
            
            <!-- Sadržaj posta -->
            <textarea rows="8" name="body" placeholder="Sadržaj" required><?= htmlspecialchars($post['body'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            
            <!-- Trenutni thumbnail -->
            <div class="form_control">
                <label>Trenutni thumbnail:</label>
                <img src="<?= ROOT_URL ?>images/<?= htmlspecialchars($post['thumbnail'], ENT_QUOTES, 'UTF-8'); ?>" alt="Thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
            </div>
            
            <!-- Promjena thumbnaila -->
            <div class="form_control">
                <label for="thumbnail">Promijeni thumbnail:</label>
                <input type="file" name="thumbnail" id="thumbnail" accept="image/*">
            </div>
            
            <!-- Gumb za potvrdu -->
            <button type="submit" name="submit" class="btn bg">Ažuriraj Post</button>
        </form>
    </div>
</section>

<?php
include "../templates/footer.php";
?>
