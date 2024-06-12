<?php

require_once("connect.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['notification_id'])) {
        $notification_id = $_POST['notification_id'];
        $stmtRemoveSNotif = $bdd->prepare("DELETE FROM notifications WHERE notificationID = :notification_id");
        $stmtRemoveSNotif->bindParam(':notification_id', $notification_id);
        $stmtRemoveSNotif->execute();
        $stmtRemoveSNotifCollab = $bdd->prepare("DELETE FROM collabnotification WHERE collaboratorID = :collaboratorID AND notificationID = :notificationID");
        $stmtRemoveSNotifCollab->bindParam(':collaboratorID', $_SESSION['id']);
        $stmtRemoveSNotifCollab->bindParam(':notificationID', $notification_id);
        $stmtRemoveSNotifCollab->execute();
    }
}