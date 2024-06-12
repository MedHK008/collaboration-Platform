<?php
    require("connect.php");
    session_start();
    $Nom = $_POST["nom"];
    $Prenom =  $_POST["prenom"] ;
   
   
    $gMail = $_POST["email"] ;
    $local = $_POST["adresse"] ;
    var_dump($_POST);
    // Rest of your code remains unchanged
    $req1="update admin set familyName=:lname, firstName=:fname, email=:mail, address=:add where adminID =:id";
    $stmt1=$bdd->prepare($req1);
    $stmt1->bindParam(":lname",$Nom,PDO::PARAM_STR);
    $stmt1->bindParam(":fname",$Prenom,PDO::PARAM_STR);
   
    $stmt1->bindParam(":mail",$gMail,PDO::PARAM_STR);
    $stmt1->bindParam(":add",$local,PDO::PARAM_STR);
    $stmt1->bindParam(":id",$_SESSION['id'],PDO::PARAM_INT);
    $stmt1->execute();
    $_SESSION['opp_succes_update_profil']=1;
    header('location: ../../gestionprofile.php#compte');
    