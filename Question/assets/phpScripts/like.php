<?php
    require('connect.php');
    session_start();
    $idcomment=$_POST['idcommentaire'];
    $idcollab=$_SESSION['id'];
    $type_react=1;
    $req_like = "INSERT INTO  collabreact (CollaboratorID, answerID, Reaction) VALUES (:CollaboratorID, :answerID, :typ)";   
    $stmt_like=$bdd->prepare($req_like);
    $stmt_like->bindParam(":CollaboratorID",$idcollab,PDO::PARAM_INT);
    $stmt_like->bindParam(":answerID",$idcomment,PDO::PARAM_INT);
    $stmt_like->bindParam(":typ",$type_react,PDO::PARAM_INT);


    $stmt_like->execute();



?>