<?php
require("connect.php");
$eventId = $_POST['event_id'];
session_start();
$req_not_participer = "DELETE FROM compose WHERE eventID = :eventID AND collaboratorID = :collaboratorID";
$stmt_not_participer = $bdd->prepare($req_not_participer);
$stmt_not_participer->bindParam(":eventID", $eventId, PDO::PARAM_INT);
$stmt_not_participer->bindParam(":collaboratorID", $_SESSION['id'], PDO::PARAM_INT);
$stmt_not_participer->execute();