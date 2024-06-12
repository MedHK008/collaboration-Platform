<?php
require("connect.php");
$eventId = $_POST['event_id'];
session_start();
$req_participer = "INSERT INTO compose VALUES (:collaboratorID, :eventID)";
$stmt_participer = $bdd->prepare($req_participer);
$stmt_participer->bindParam(":collaboratorID", $_SESSION['id'], PDO::PARAM_INT);
$stmt_participer->bindParam(":eventID", $eventId, PDO::PARAM_INT);
$stmt_participer->execute();