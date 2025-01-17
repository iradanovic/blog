<?php 
include 'templates/header.php';

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

// Paginacija - postavke
$posts_per_page = 6;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_page = max(1, $current_page); // Osigurajte da stranica ne bude manja od 1
$offset = ($current_page - 1) * $posts_per_page;

// Ukupan broj postova
$total_posts_query = "SELECT COUNT(*) AS total FROM posts";
$total_posts_result = $connection->query($total_posts_query);
$total_posts = $total_posts_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $posts_per_page);

// Dohvaćanje postova za trenutnu stranicu
$posts_query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT ? OFFSET ?";
$stmt = $connection->prepare($posts_query);
$stmt->bind_param("ii", $posts_per_page, $offset);
$stmt->execute();
$posts_result = $stmt->get_result();
$stmt->close();
?>

<!-- Sekcija za postove -->
<section class="posts section_extra-margin">
    <div class="container posts_container">
        <?php if ($posts_result->num_rows > 0): ?>
            <?php while ($post = $posts_result->fetch_assoc()): ?>
                <article class="post">
                    <div class="post_thumbnail" style="width: 300px; height: 200px;">
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
                        <p class="post_body" style="min-height: 100px;">
                            <?= htmlspecialchars(substr($post['body'], 0, 150)) ?>...
                        </p>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="alert_message error">Trenutno nema dostupnih postova.</p>
        <?php endif; ?>
    </div>

    <!-- Paginacija -->
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php if ($current_page > 1): ?>
                <a href="<?= ROOT_URL ?>blog.php?page=<?= $current_page - 1 ?>" class="pagination_button">&laquo; Prethodna</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="<?= ROOT_URL ?>blog.php?page=<?= $i ?>" class="pagination_button <?= $i === $current_page ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="<?= ROOT_URL ?>blog.php?page=<?= $current_page + 1 ?>" class="pagination_button">Sljedeća &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php include 'templates/footer.php'; ?>
