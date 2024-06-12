<?php
    require('connect.php');
    session_start();
    $idcomment=$_POST['idcommentaire'];
    $idcollab=$_SESSION['id'];
    $type_react=0;
    $req_dislike = "INSERT INTO  collabreact (CollaboratorID, answerID, Reaction) VALUES (:CollaboratorID, :answerID, :typ)";   
    $stmt_dislike=$bdd->prepare($req_dislike);
    $stmt_dislike->bindParam(":CollaboratorID",$idcollab,PDO::PARAM_INT);
    $stmt_dislike->bindParam(":answerID",$idcomment,PDO::PARAM_INT);
    $stmt_dislike->bindParam(":typ",$type_react,PDO::PARAM_INT);


    $stmt_dislike->execute();



?>