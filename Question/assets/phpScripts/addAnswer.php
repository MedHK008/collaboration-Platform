<?php
require_once "connect.php" ;
session_start();
$questionID=$_POST['questionID'];
$comment=$_POST['comment'];
$add_comment="insert into answer (answerText) values (:comments)";
$stmt_comment=$bdd->prepare($add_comment);
$stmt_comment->bindParam(":comments",$comment,PDO::PARAM_STR);
$stmt_comment->execute();
$get_last__comment="SELECT answerID from answer where answerID >=all(SELECT answerID from answer) ";
$stmt_get_last_comment=$bdd->prepare($get_last__comment);
$stmt_get_last_comment->execute();
$res_get_last_comment=$stmt_get_last_comment->fetch();
$add_reps_to_table="insert into collabanswer values(:idcollab , :idquestion,:idanswer)";
$stmt_add_reps_to_table=$bdd->prepare($add_reps_to_table);
$stmt_add_reps_to_table->bindParam(":idcollab",$_SESSION['id'],PDO::PARAM_INT);
$stmt_add_reps_to_table->bindParam(":idquestion",$questionID,PDO::PARAM_INT);
$stmt_add_reps_to_table->bindParam(":idanswer",$res_get_last_comment['answerID'],PDO::PARAM_INT);
$stmt_add_reps_to_table->execute();
$req_count_comments="SELECT count(answerID) as count FROM collabanswer where questionID=:idquestion";
$stmt_count_comments=$bdd->prepare($req_count_comments);
$stmt_count_comments->bindParam(":idquestion",$questionID,PDO::PARAM_INT);
$stmt_count_comments->execute();
$count_comments=$stmt_count_comments->fetch(PDO::FETCH_ASSOC);
if ($count_comments['count'] >=1 && $count_comments['count']<5) {
    $req_set_en_cours = "UPDATE question SET stateID = 3 WHERE questionID=:idquestion";
    $stmt_set_en_cours = $bdd->prepare($req_set_en_cours);
    $stmt_set_en_cours->bindParam(":idquestion",$questionID,PDO::PARAM_INT);
    $stmt_set_en_cours->execute();
}
elseif ($count_comments['count'] == 5)
{
    $req_set_complete = "UPDATE question SET stateID = 4 WHERE questionID=:idquestion";
    $stmt_set_complete = $bdd->prepare($req_set_complete);
    $stmt_set_complete->bindParam(":idquestion",$questionID,PDO::PARAM_INT);
    $stmt_set_complete->execute();
    $req_select_question_owner = "SELECT collaboratorID FROM question WHERE questionID=:idquestion";
    $stmt_select_question_owner = $bdd->prepare($req_select_question_owner);
    $stmt_select_question_owner->bindParam(":idquestion",$questionID,PDO::PARAM_INT);
    $stmt_select_question_owner->execute();
    $collaborator_id_fetch=$stmt_select_question_owner->fetch(PDO::FETCH_ASSOC);
    $collaborator_id=$collaborator_id_fetch['collaboratorID'];
    $req_notification = "INSERT into notifications (message) values (:message)";
    $stmt_notification = $bdd->prepare($req_notification);
    $notifcation_message = "Votre question a recu 5 reponses. Elle est complete.";
    $stmt_notification->bindParam(":message",$notifcation_message,PDO::PARAM_STR);
    $stmt_notification->execute();
    $notificationID = $bdd->lastInsertId();
    $req_notif_collab = "INSERT into collabnotification (collaboratorID, notificationID) VALUES (:collaboratorID, :notificationID)";
    $stmt_notif_collab = $bdd->prepare($req_notif_collab);
    $stmt_notif_collab->bindParam(":collaboratorID",$collaborator_id,PDO::PARAM_INT);
    $stmt_notif_collab->bindParam(":notificationID",$notificationID,PDO::PARAM_INT);
    $stmt_notif_collab->execute();

}

header("location:../../Accueil.php");
