<?php 
include 'templates/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();

} else {
    header("Location: blog.php");
    exit();
}

?>
    <!-- Single Post View -->
    <section class="singlepost">
        <div class="container singlepost_container">
            <h2><?= htmlspecialchars($post['title']) ?></h2>
            <div class="singlepost_thumbnail">
                <img src="./images/<?= htmlspecialchars($post['thumbnail']) ?>" alt="Post Image">
            </div>
            <p><?= htmlspecialchars($post['body']) ?></p>
        </div>
    </section>

    

    <?php include 'templates/footer.php'; ?>
</body>
</html>
