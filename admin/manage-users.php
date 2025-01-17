<?php
include "partials/header.php";

// Dohvaćanje korisnika iz baze
$query = "SELECT id, firstname, lastname, username FROM users";
$users = mysqli_query($connection, $query);
?>

<section class="dashboard">
    <!-- Prikaz poruka o uspjehu i greškama -->
    <?php if (isset($_SESSION['add-user-success'])): ?>
        <div class="alert_message success container">
            <p><?= htmlspecialchars($_SESSION['add-user-success'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['add-user-success']); ?>
        </div>
    <?php elseif (isset($_SESSION['edit-user'])): ?>
        <div class="alert_message error container">
            <p><?= htmlspecialchars($_SESSION['edit-user'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['edit-user']); ?>
        </div>
    <?php elseif (isset($_SESSION['edit-user-success'])): ?>
        <div class="alert_message success container">
            <p><?= htmlspecialchars($_SESSION['edit-user-success'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['edit-user-success']); ?>
        </div>
    <?php elseif (isset($_SESSION['delete-user'])): ?>
        <div class="alert_message error container">
            <p><?= htmlspecialchars($_SESSION['delete-user'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['delete-user']); ?>
        </div>
    <?php elseif (isset($_SESSION['delete-user-success'])): ?>
        <div class="alert_message success container">
            <p><?= htmlspecialchars($_SESSION['delete-user-success'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php unset($_SESSION['delete-user-success']); ?>
        </div>
    <?php endif; ?>

    <div class="container dashboard_container">
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
            <h2>Upravljanje Korisnicima</h2>
            <?php if (mysqli_num_rows($users) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Ime i Prezime</th>
                            <th>Korisničko Ime</th>
                            <th>Uredi</th>
                            <th>Izbriši</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['firstname'] . " " . $user['lastname'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Uredi</a></td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger" onclick="return confirm('Jeste li sigurni da želite izbrisati korisnika?');">Izbriši</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert_message error">Nema pronađenih korisnika.</div>
            <?php endif; ?>
        </main>
    </div>
</section>

<?php
include "../templates/footer.php";
?>
