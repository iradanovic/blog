<?php 
include 'templates/header.php';

// Dohvati podatke o korisniku ako je prijavljen
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

// Dohvati hero post
$hero_query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 1";
$hero_result = $connection->query($hero_query);
$hero_post = $hero_result->fetch_assoc();

// Dohvati dodatne postove
$posts_query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 3 OFFSET 1";
$posts_result = $connection->query($posts_query);
?>

<!-- Hero sekcija -->
<?php if ($hero_post): ?>
<section class="hero">
    <div class="container hero_container">
        <div class="post_thumbnail">
            <a href="<?= ROOT_URL ?>post.php?id=<?= $hero_post['id'] ?>">
                <img src="./images/<?= htmlspecialchars($hero_post['thumbnail']) ?>" alt="Hero Post Image">
            </a>
        </div>
        <div class="post_info">
            <h2 class="post_title">
                <a href="<?= ROOT_URL ?>post.php?id=<?= $hero_post['id'] ?>">
                    <?= htmlspecialchars($hero_post['title']) ?>
                </a>
            </h2>
            <p class="post_body">
                <?= htmlspecialchars(substr($hero_post['body'], 0, 900)) ?>...
            </p>
        </div>
    </div>
</section>
<?php else: ?>
<section class="hero">
    <div class="container hero_container">
        <p class="alert_message error">Trenutno nema dostupnih postova.</p>
    </div>
</section>
<?php endif; ?>

<!-- Sekcija za postove -->
<section class="posts">
    <div class="container posts_container">
        <?php if ($posts_result->num_rows > 0): ?>
            <?php while ($post = $posts_result->fetch_assoc()): ?>
            <article class="post">
                <div class="post_thumbnail">
                    <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                        <img src="./images/<?= htmlspecialchars($post['thumbnail']) ?>" alt="Post Image">
                    </a>
                </div>
                <div class="post_info">
                    <h2 class="post_title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                            <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </h2>
                    <p class="post_body">
                        <?= htmlspecialchars(substr($post['body'], 0, 150)) ?>...
                    </p>
                </div>
            </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="alert_message error">Trenutno nema dodatnih postova.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'templates/footer.php'; ?>
