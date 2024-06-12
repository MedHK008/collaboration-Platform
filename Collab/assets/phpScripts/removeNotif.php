<?php

require_once("connect.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $stmtRemoveSNotif = $bdd->prepare("DELETE FROM collabnotification WHERE collaboratorID = :collaboratorID");
        $stmtRemoveSNotif->bindParam(':collaboratorID', $_SESSION['id']);
        $stmtRemoveSNotif->execute();
}