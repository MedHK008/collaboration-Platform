<?php
    require("connect.php");
    session_start();
    $Nom = $_POST["nom"];
    $Prenom =  $_POST["prenom"] ;
    $bDate = $_POST["dateNaissance"] ;
    $cin =$_POST["cin"] ;
    $gMail = $_POST["email"] ;
    $local = $_POST["adresse"] ;
    $spec =$_POST["specialite"];
    // Rest of your code remains unchanged
    $req="update collaborator set familyName=:lname, firstName=:fname, cin=:cin, BirthDate=:bd, email=:mail, address=:add, speciality=:spec where collaboratorID =:id";
    $stmt=$bdd->prepare($req);
    $stmt->bindParam(":lname",$Nom,PDO::PARAM_STR);
    $stmt->bindParam(":fname",$Prenom,PDO::PARAM_STR);
    $stmt->bindParam(":cin",$cin,PDO::PARAM_STR);
    $stmt->bindParam(":bd",$bDate,PDO::PARAM_STR);
    $stmt->bindParam(":mail",$gMail,PDO::PARAM_STR);
    $stmt->bindParam(":add",$local,PDO::PARAM_STR);
    $stmt->bindParam(":spec",$spec,PDO::PARAM_STR);
    $stmt->bindParam(":id",$_SESSION['id'],PDO::PARAM_INT);
    
    $stmt->execute();
    $_SESSION['opp_succes_update_profil']=1;
    header('location: ../../gestionprofile.php#gestecompte');
    