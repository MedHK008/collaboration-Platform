<?php
    require('connect.php');
    session_start();
    $idcomment=$_POST['idcommentaire'];
    $idcollab=$_SESSION['id'];
    $req_delete_dislike = "DELETE FROM collabreact WHERE CollaboratorID = :CollaboratorID AND answerID = :answerID AND Reaction = 0" ;
    $stmt_delete_dislike = $bdd->prepare($req_delete_dislike);
    $stmt_delete_dislike->bindParam(":CollaboratorID", $idcollab, PDO::PARAM_INT);
    $stmt_delete_dislike->bindParam(":answerID", $idcomment, PDO::PARAM_INT);
    $stmt_delete_dislike->execute();
?>