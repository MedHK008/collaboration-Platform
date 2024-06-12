<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment_id']) && isset($_POST['comment_text'])) {
        $comment_id = $_POST['comment_id'];
        $comment_text = $_POST['comment_text'];
        $collaborator_id = $_SESSION['id'];

        // Check if the comment belongs to the logged-in user
        $check_query = "SELECT * FROM collabanswer WHERE answerID = :answerID AND collaboratorID = :collaboratorID";
        $stmt_check = $bdd->prepare($check_query);
        $stmt_check->bindParam(':answerID', $comment_id, PDO::PARAM_INT);
        $stmt_check->bindParam(':collaboratorID', $collaborator_id, PDO::PARAM_INT);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            // Update the comment
            $update_query = "UPDATE answer SET answerText = :answerText WHERE answerID = :answerID";
            $stmt_update = $bdd->prepare($update_query);
            $stmt_update->bindParam(':answerText', $comment_text, PDO::PARAM_STR);
            $stmt_update->bindParam(':answerID', $comment_id, PDO::PARAM_INT);
            $stmt_update->execute();

            // Redirect back to the comments page
            header('Location: comments_page.php'); // Update this to your comments page URL
            exit;
        } else {
            echo "You are not authorized to edit this comment.";
        }
    }
}
?>
