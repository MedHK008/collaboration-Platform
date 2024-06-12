<?php
require_once("connect.php");
$Competence=$_POST['Competence'];
$description=$_POST['description'];
$req="INSERT INTO skill(skillName,skillDescription) VALUES(:Competence,:description)";
$stmt=$bdd->prepare($req);
$stmt->bindParam(':Competence',$Competence,PDO::PARAM_STR);
$stmt->bindParam(':description',$description,PDO::PARAM_STR);
$stmt->execute();
header('location:../../../Profil_admin/my_view.php#Competences');
