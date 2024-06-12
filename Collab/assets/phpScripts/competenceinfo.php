<?php
    $req10="select skillName from skill";
    $stmt2=$bdd->prepare($req10);
    $stmt2->execute();
    $res10=$stmt2->fetchAll(PDO::FETCH_ASSOC);
    $req11="select levelName from level";
    $stmt3=$bdd->prepare($req11);
    $stmt3->execute();
    $res11=$stmt3->fetchAll(PDO::FETCH_ASSOC);
    $req1="select skillName,skillDescription,levelName from level natural join skill natural join collabhasskill where collaboratorID =:id ";
    $stmt=$bdd->prepare($req1);
    $stmt->bindParam(":id",$_SESSION['id'],PDO::PARAM_INT);
    $stmt->execute();
    $comp=$stmt->fetchAll(PDO::FETCH_ASSOC);