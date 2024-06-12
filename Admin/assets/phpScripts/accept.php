<?php
require_once("connect.php");
$id = $_GET['id'];

$req = 'SELECT * FROM demande WHERE demandeID = :id';
$stmt=$bdd->prepare($req);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch();

$name=$row['name'];
$prenom=$row['familyname'];
$email=$row['email'];
$password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
$req="INSERT INTO collaborator(familyName,firstName,email,password) VALUES(:nom,:prenom,:email,:password)";
$stmt=$bdd->prepare($req);
$stmt->bindParam(':nom',$name,PDO::PARAM_STR);
$stmt->bindParam(':prenom',$prenom,PDO::PARAM_STR);
$stmt->bindParam(':email',$email,PDO::PARAM_STR);
$stmt->bindParam(':password',$password,PDO::PARAM_STR);
$stmt->execute();
$lastInsertId = $bdd->lastInsertId();
$to = $email;
$subject = "Your Collaborator Account Details";
$message = "Hello " . $prenom . " " . $name . ",\n\nYour collaborator account has been created successfully.\n\nYour ID: " . $lastInsertId . "\nYour Password: " . $password . "\n\nPlease change your password upon first login.";
$headers = "From: admin@collabplatfrom.com";

mail($to, $subject, $message, $headers);

$reqDelete = 'DELETE FROM demande WHERE demandeID = :id';
$stmtDelete = $bdd->prepare($reqDelete);
$stmtDelete->bindParam(':id', $id);
$stmtDelete->execute();


header('location:../../../Profil_admin/my_view.php#Collaborateurs');
