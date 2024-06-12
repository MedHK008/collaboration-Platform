<?php
    require("connect.php");
    $questionId = $_POST['courseID'];
    session_start();
    $req_not_interesser = "DELETE FROM signin WHERE courseID = :courseID AND collaboratorID = :collaboratorID";
    $stmt_not_interesser = $bdd->prepare($req_not_interesser);
    $stmt_not_interesser->bindParam(":courseID", $questionId, PDO::PARAM_INT);
    $stmt_not_interesser->bindParam(":collaboratorID", $_SESSION['id'], PDO::PARAM_INT);
    $stmt_not_interesser->execute();
