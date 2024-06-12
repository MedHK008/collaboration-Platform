<?php

require_once("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['course_id'])) {
        $course_id = $_POST['course_id'];
        $stmtRolloutCourse = $bdd->prepare("DELETE FROM signin WHERE courseID = :course_id AND collaboratorID = :collaborator_id");
        $stmtRolloutCourse->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmtRolloutCourse->bindParam(':collaborator_id', $_SESSION['id'], PDO::PARAM_INT);
        $stmtRolloutCourse->execute();
    }
}


