<?php
require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $projectId = $_GET['id'];

    $deleteQuery = "DELETE FROM project WHERE projectID = :projectId";
    $stmt = $bdd->prepare($deleteQuery);
    $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('location:../../../Profil_admin/my_view.php#Projects');

    } else {
        echo "Error deleting project";
    }
} else {
    echo "Invalid request or missing ID";
}
