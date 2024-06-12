<?php
    require("connect.php");
    session_start();
    $id=$_POST["id"];
    $password=$_POST["motPass"];
    $req="select * from collaborator";
    $stmt=$bdd->prepare($req);
    $stmt->execute();
    $list=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['connect']=1;
    foreach($list as $row)
    {
        if($id==$row['collaboratorID'] && $password==$row['password'])
        {
            $_SESSION['id']=$id ;
            $_SESSION['connect']=1;
            
            header('location:../../../Question/Accueil.php');
            exit;
        }
        
    }
    $_SESSION['false_pass']=0;
    header('location:../../index.php');