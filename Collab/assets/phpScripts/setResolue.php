<?php

require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['question_id'])) {
        $question_id = $_POST['question_id'];
        $stmtResolue = $bdd->prepare("UPDATE question SET stateID = 5 where questionID = :question_id");
        $stmtResolue->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $stmtResolue->execute();
    }
}