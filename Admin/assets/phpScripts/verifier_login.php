<?php
    require("connect.php");
    session_start();
    $id=$_POST["id"];
    $password=$_POST["motPass"];
    $req0="select * from admin";
    $stmt0=$bdd->prepare($req0);
    $stmt0->execute();
    $list0=$stmt0->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['connect']=1;
    foreach($list0 as $row)
    {
        if($id==$row['adminID'] && $password==$row['password'])
        {
            $_SESSION['id']=$id ;
            $_SESSION['connect']=1;
            header('location:../../../Profil_admin/my_view.php');
            exit;
        }
        
    }
    $_SESSION['false_pass']=0;
    header('location:../../index.php');