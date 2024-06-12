<?php
require_once("connect.php");
$id = $_GET['id'];

$reqDelete = 'DELETE FROM demande WHERE demandeID = :id';
$stmtDelete = $bdd->prepare($reqDelete);
$stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
$stmtDelete->execute();

header('location:../../../Profil_admin/my_view.php#demandes');

