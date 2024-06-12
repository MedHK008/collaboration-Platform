<?php
require_once("connect.php");
session_start();
$projectRoleName = $_POST["roles"];
$req1 = "SELECT roleID FROM role WHERE roleName = :projectRoleName";
$stmt = $bdd->prepare($req1);
$stmt->bindValue(":projectRoleName", $projectRoleName);
$stmt->execute();
$projectRoleID = $stmt->fetchColumn();


$projectName = $_POST["project"];
echo"hello".$projectName;
$req3 = "SELECT projectID FROM project WHERE projectTitle = :projectName";
$stmt = $bdd->prepare($req3);
$stmt->bindValue(":projectName", $projectName);
$stmt->execute();
$projectID = $stmt->fetchColumn();

$req_select1 = "SELECT * FROM affected where collaboratorID =:id and projectID =:idpr and roleID =:idr ";
$stmt_select1 = $bdd->prepare($req_select1);
$stmt_select1->bindValue(":id", $_SESSION['id']);
$stmt_select1->bindValue(":idpr", $projectID);
$stmt_select1->bindValue(":idr", $projectRoleID);
$stmt_select1->execute();

if ($stmt_select1->rowCount() == 0) {
    // If no rows exist, insert a new row
    $req_insert1 = "INSERT INTO affected (collaboratorID, projectID, roleID) VALUES (:id, :idpr, :idr)";
    $stmt_insert1 = $bdd->prepare($req_insert1);
    $stmt_insert1->bindValue(":id", $_SESSION['id']);
    $stmt_insert1->bindValue(":idpr", $projectID);
    $stmt_insert1->bindValue(":idr", $projectRoleID);
    $stmt_insert1->execute();
}
header("Location: ../../gestionprofile.php#gesteprojects");

exit;