<?php
require_once("connect.php");

if (isset($_GET['id'])) {
    $courseID = $_GET['id'];
    $reqFormationDelete = "DELETE FROM trainingprogram WHERE courseID = :questionID";
    $stmtFormationDelete = $bdd->prepare($reqFormationDelete);
    $stmtFormationDelete->bindParam(':questionID', $courseID, PDO::PARAM_INT);
    $stmtFormationDelete->execute();
    header('Location: ../../../Profil_admin/my_view.php#formation');
}