<?php 
     $req3="select * from collaborator";
     $stmt3=$bdd->prepare($req3);
     $stmt3->execute();
     $res3=$stmt3->fetchAll(PDO::FETCH_ASSOC);