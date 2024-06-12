<?php
require_once("connect.php");

if (isset($_GET['id'])) {
    $questionID = $_GET['id'];
    $reqQuestionDelete = "DELETE FROM question WHERE questionID = :questionID";
    $stmtQuestionDelete = $bdd->prepare($reqQuestionDelete);
    $stmtQuestionDelete->bindParam(':questionID', $questionID, PDO::PARAM_INT);
    $stmtQuestionDelete->execute();
    header('Location: ../../../Profil_admin/my_view.php#question');
}