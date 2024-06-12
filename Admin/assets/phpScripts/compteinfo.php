<?php
    $req2="select * from admin where adminID =:id";
    $stmt2=$bdd->prepare($req2);
    $stmt2->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
    $stmt2->execute();
    $res2=$stmt2->fetch(PDO::FETCH_ASSOC);

 
?>