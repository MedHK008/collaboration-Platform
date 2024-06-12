<?php
require_once("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $debut = $_POST['debut'];
    $desc = $_POST['desc'];
    $fin = $_POST['fin'];

    $req = "INSERT INTO project (projectTitle,startDate, projectDescription, endDate) VALUES (:titre, :debut, :desc, :fin)";
    $stmt = $bdd->prepare($req);
    $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
    $stmt->bindParam(':debut', $debut, PDO::PARAM_STR);
    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
    $stmt->bindParam(':fin', $fin, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header('location:../../../Profil_admin/my_view.php#Projects');
    } else {
        echo "Error adding project";
    }
} else {
    echo "Invalid request method";
}


