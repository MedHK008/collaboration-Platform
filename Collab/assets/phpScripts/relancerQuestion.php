<?php

require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['question_id'])) {
        $question_id = $_POST['question_id'];
        $stmtRelancer = $bdd->prepare("UPDATE question SET stateID = 2 where questionID = :question_id");
        $stmtRelancer->bindParam(':question_id', $question_id, PDO::PARAM_INT);
        $stmtRelancer->execute();
    }
}