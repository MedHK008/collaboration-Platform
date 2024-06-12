<?php
    session_start();
    require('connect.php');
    $req12="update admin set imageUrl=:img where adminID =:id";
    if(isset($_POST['submit'])){
    $file_name=$_FILES['img']['name'];
    $file_type=$_FILES['img']['type'];
    $file_error=$_FILES['img']['error'];
    $file_temp_name=$_FILES['img']['tmp_name'];
    $fileExt=explode('.',$file_name);
    $fileActualExt=strtolower(end($fileExt));
    $allow=array('jpg','jpeg','png');
    if(in_array($fileActualExt,$allow)){
        if($file_error==0)
        {
            $file_name=$_SESSION['id'].".".$fileActualExt;
            $file_dest="..\admin_image\\".$file_name ;
            echo $file_name;
            move_uploaded_file($file_temp_name,$file_dest);
            $stmt12=$bdd->prepare($req12);
            $stmt12->bindParam(':img',$file_name,PDO::PARAM_STR);
            $stmt12->bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
            $stmt12->execute();
            header('location:../../gestionprofile.php');
            exit;
        }
        else{
            echo"error";
            $_SESSION['allow']=-1;
            exit;
        }
    }
    else {
        echo"error of type";
        $_SESSION['allow']=0;
        exit;
    }
    
}


?>