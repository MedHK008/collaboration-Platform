<?php
    require('connect.php');
    session_start();
    $idcomment=$_POST['idcommentaire'];
    $idcollab=$_SESSION['id'];
    $req_delete_like = "DELETE FROM collabreact WHERE CollaboratorID = :CollaboratorID AND answerID = :answerID AND Reaction = 1" ;
    $stmt_delete_like = $bdd->prepare($req_delete_like);
    $stmt_delete_like->bindParam(":CollaboratorID", $idcollab, PDO::PARAM_INT);
    $stmt_delete_like->bindParam(":answerID", $idcomment, PDO::PARAM_INT);
    $stmt_delete_like->execute();
?>