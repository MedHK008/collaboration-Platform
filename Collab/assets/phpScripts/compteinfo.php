<?php
    require('connect.php');
    $req8="select * from collaborator where collaboratorID =:id";
    $stmt8=$bdd->prepare($req8);
    $stmt8->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
    $stmt8->execute();
    $res8=$stmt8->fetch(PDO::FETCH_ASSOC);
?>