<?php
    require('connect.php');
    $req4="Select projectTitle,rolename from affected natural join role natural join project where collaboratorID=:id";
    $stmt4=$bdd->prepare($req4);
    $stmt4->bindParam(":id",$_SESSION['id'],PDO::PARAM_INT);
    $stmt4->execute();
    $res4=$stmt4->fetchAll(PDO::FETCH_ASSOC);

    $req5="SELECT projectTitle FROM project";
    $stmt5=$bdd->prepare($req5);
    $stmt5->execute();
    $res5=$stmt5->fetchAll(PDO::FETCH_ASSOC);

    $req6="SELECT rolename FROM role";
    $stmt6=$bdd->prepare($req6);
    $stmt6->execute();
    $res6=$stmt6->fetchAll(PDO::FETCH_ASSOC);

    $req7="SELECT familyName FROM collaborator";
    $stmt7=$bdd->prepare($req7);
    $stmt7->execute();
    $res7=$stmt7->fetchAll(PDO::FETCH_ASSOC);
