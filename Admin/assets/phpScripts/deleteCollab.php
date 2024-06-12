<?php
    require_once("connect.php");
    $id=$_GET['id'];
    $req="DELETE FROM collaborator WHERE collaboratorID=$id";
    $stmt=$bdd->prepare($req);
    $stmt->execute();
    header('location:../../../Profil_admin/my_view.php#Collaborateurs');

