<?php
session_start();
require("connect.php");

$fullname = $_POST['fullname'];
$fullname_splited = explode(" ", $fullname);
$fullname_splited = array_pad($fullname_splited, 2, null);
list($name, $familyname) = $fullname_splited;
$email = $_POST['email'];

$sql = "SELECT COUNT(*) FROM demande WHERE name = :name AND familyname = :familyname AND email = :email";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':name', $name,PDO::PARAM_STR);
$stmt->bindParam(':familyname', $familyname,PDO::PARAM_STR);
$stmt->bindParam(':email', $email,PDO::PARAM_STR);
$stmt->execute();
$userExists = $stmt->fetchColumn();
$sql1 = "SELECT COUNT(*) FROM collaborator WHERE firstName = :name OR familyName = :familyname OR email = :email";
$stmt1 = $bdd->prepare($sql1);
$stmt1->bindParam(':name', $name,PDO::PARAM_STR);
$stmt1->bindParam(':familyname', $familyname,PDO::PARAM_STR);
$stmt1->bindParam(':email', $email,PDO::PARAM_STR);
$stmt1->execute();
$userExists1 = $stmt1->fetchColumn();

if ($userExists) {

    $_SESSION["demande"] = 2;

}
elseif($userExists1){
    $_SESSION["demande"] = 3;
}
else {
    // User does not exist, proceed with the insert
    $sql = "INSERT INTO demande (name, familyname, email) VALUES (:name, :familyname, :email)";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':name', $name,PDO::PARAM_STR);
    $stmt->bindParam(':familyname', $familyname,PDO::PARAM_STR);
    $stmt->bindParam(':email', $email,PDO::PARAM_STR);
    $stmt->execute();
    $_SESSION["demande"] = 1; // Indicate successful insertion
}

header("location:../../demande.php");
