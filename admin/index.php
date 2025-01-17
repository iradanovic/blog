<?php
// Omogućite prikaz pogrešaka za razvoj (uklonite u produkciji)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "partials/header.php";

// Dohvati postove iz baze
$query = "SELECT id, title FROM posts ORDER BY id DESC";
$posts = mysqli_query($connection, $query);
?>

<section class="dashboard">
    <!-- Prikaz poruka o uspjehu/greškama -->
    <?php if (isset($_SESSION['signin-success'])): ?>
        <div class="alert_message success container">
            <p><?= htmlspecialchars($_SESSION['signin-success'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['signin-success']); ?>
        </div>
    <?php elseif (isset($_SESSION['add-post'])): ?>
        <div class="alert_message error container">
            <p><?= htmlspecialchars($_SESSION['add-post'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['add-post']); ?>
        </div>
    <?php elseif (isset($_SESSION['add-post-success'])): ?>
        <div class="alert_message success container">
            <p><?= htmlspecialchars($_SESSION['add-post-success'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['add-post-success']); ?>
        </div>
    <?php elseif (isset($_SESSION['edit-post'])): ?>
        <div class="alert_message error container">
            <p><?= htmlspecialchars($_SESSION['edit-post'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['edit-post']); ?>
        </div>
    <?php elseif (isset($_SESSION['edit-post-success'])): ?>
        <div class="alert_message success container">
            <p><?= htmlspecialchars($_SESSION['edit-post-success'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['edit-post-success']); ?>
        </div>
    <?php endif; ?>

    <div class="container dashboard_container">
        <!-- Sidebar navigacija -->
        <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>

        <aside>
            <ul>
                <li><a href="<?= ROOT_URL ?>admin/add-post.php"><i class="uil uil-pen"></i><h5>Dodaj Post</h5></a></li>
                <li><a href="<?= ROOT_URL ?>admin/index.php" class="active"><i class="uil uil-postcard"></i><h5>Upravljanje Postovima</h5></a></li>
                <li><a href="<?= ROOT_URL ?>admin/add-user.php"><i class="uil uil-user-plus"></i><h5>Dodaj Korisnika</h5></a></li>
                <li><a href="<?= ROOT_URL ?>admin/manage-users.php"><i class="uil uil-users-alt"></i><h5>Upravljanje Korisnicima</h5></a></li>

            </ul>
        </aside>

        <main>
            <h2>Upravljanje Postovima</h2>
            <?php if (mysqli_num_rows($posts) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Naslov</th>
                            <th>Uredi</th>
                            <th>Izbriši</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                            <tr>
                                <td><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn sm">Uredi</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger" onclick="return confirm('Jeste li sigurni da želite izbrisati ovaj post?');">Izbriši</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert_message error">Nema pronađenih postova.</div>
            <?php endif; ?>
        </main>
    </div>
</section>

<?php
include "../templates/footer.php";
?>
