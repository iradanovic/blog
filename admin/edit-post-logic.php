<?php
require 'database.php';

if (isset($_POST['submit'])) {
    // Sanitize input values
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $thumbnail = $_FILES['thumbnail'];

    // Validate input values
    if (!$title || !$body) {
        $_SESSION['edit-post'] = "Couldn't update post. Invalid form data on edit page.";
        header('location: ' . ROOT_URL . 'admin/');
        die();
    }

    $thumbnail_to_insert = $previous_thumbnail_name;

    // Handle new thumbnail upload if a new file is provided
    if ($thumbnail['name']) {
        $allowed_files = ['jpg', 'png', 'jpeg'];
        $extension = strtolower(pathinfo($thumbnail['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $allowed_files)) {
            $_SESSION['edit-post'] = "File should be in PNG, JPG, or JPEG format.";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }

        if ($thumbnail['size'] > 2 * 1024 * 1024) { // Check file size (2MB limit)
            $_SESSION['edit-post'] = "File size too large. Should be less than 2MB.";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }

        // Delete the previous thumbnail
        $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
        if (file_exists($previous_thumbnail_path)) {
            unlink($previous_thumbnail_path);
        }

        // Rename and move the new thumbnail
        $new_thumbnail_name = time() . '-' . $thumbnail['name'];
        $thumbnail_destination_path = '../images/' . $new_thumbnail_name;

        if (!move_uploaded_file($thumbnail['tmp_name'], $thumbnail_destination_path)) {
            $_SESSION['edit-post'] = "Failed to upload the new thumbnail.";
            header('location: ' . ROOT_URL . 'admin/');
            die();
        }

        $thumbnail_to_insert = $new_thumbnail_name;
    }

    // Update the post in the database
    $query = "UPDATE posts SET title = ?, body = ?, thumbnail = ? WHERE id = ? LIMIT 1";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('sssi', $title, $body, $thumbnail_to_insert, $id);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['edit-post-success'] = "Post updated successfully.";
    } else {
        $_SESSION['edit-post'] = "Failed to update the post.";
    }

    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>
