<?php
    session_start();
    require_once("connect.php");
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    $confpass=$_POST['confirmpass'];
    $req='select password from collaborator where collaboratorID=:id';
    $stmt=$bdd->prepare($req);
    $stmt->bindParam(":id",$_SESSION['id'],PDO::PARAM_INT);
    $stmt->execute();
    $res=$stmt->fetch(PDO::FETCH_ASSOC);
    if($res['password']==$oldpass)
    {
        $req1="update collaborator set password =:pass where collaboratorID =:id";
        $stmt1=$bdd->prepare($req1);
        $stmt1->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
        $stmt1->bindParam(':pass',$newpass,PDO::PARAM_STR);
        $_SESSION['update_pass']=1;
        $stmt1->execute();
        header('location: ../../gestionprofile.php#gestepassword');
    }
    else {
        $_SESSION['false_old_pass']=0;
        header('location: ../../gestionprofile.php#gestepassword');
    }