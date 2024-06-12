<?php 
require_once("connect.php");

if (isset($_GET['id'])) {
    $skillId = $_GET['id'];
    $req = "DELETE FROM skill WHERE skillID = :skillId";
    $stmt = $bdd->prepare($req);
    $stmt->bindParam(':skillId', $skillId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header('location:../../../Profil_admin/my_view.php#Competences');

    } else {
        echo "Error deleting record";
    }
} else {
    echo "Error: Skill ID not provided";
}
