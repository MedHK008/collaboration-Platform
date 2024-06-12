<?php

require_once("connect.php");

if (isset($_GET['id'])) {
    $eventID= $_GET['id'];
    $reqEventDelete= "DELETE FROM event WHERE eventID= :eventID";
    $stmtEventDelete= $bdd->prepare($reqEventDelete);
    $stmtEventDelete->bindParam(':eventID', $eventID, PDO::PARAM_INT);
    $stmtEventDelete->execute();
    header('Location: ../../../Profil_admin/my_view.php#event');
}
