<?php
    session_start();
    require_once("connect.php");
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $confpass=$_POST['confirmpass'];
    $req3='select password from admin where adminID=:id';
    $stmt3=$bdd->prepare($req3);
    $stmt3->bindParam(":id",$_SESSION['id'],PDO::PARAM_INT);
    $stmt3->execute();
    $res3=$stmt3->fetch(PDO::FETCH_ASSOC);
    if($res3['password']==$oldpass)
    {
        $req4="update admin set password =:pass where adminID =:id";
        $stmt4=$bdd->prepare($req4);
        $stmt4->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
        $stmt4->bindParam(':pass',$newpass,PDO::PARAM_STR);
        $_SESSION['update_pass']=1;
        $stmt4->execute();
        header('location: ../../gestionprofile.php#password');
        exit ;
    }
    else {
        $_SESSION['false_old_pass']=0;
        header('location: ../../gestionprofile.php#password');
    }