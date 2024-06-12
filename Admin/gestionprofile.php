<?php
session_start();
require('assets/phpScripts/connect.php');
require('assets/phpScripts/compteinfo.php');
require('assets/phpScripts/collabinfo.php');
require('assets/phpScripts/skillinfo.php');
require('assets/phpScripts/projectinfo.php');
require('assets/phpScripts/demandeinfo.php');

if (!isset($_SESSION['id']) ) 
{
 header('Location:../Admin/index.php');
 exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametres du profil administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="assets/js/index.js" async></script>
    <script src="assets/js/password.js" async></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="gestionprofile.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/css/header.css">

</head>

<body>

<header>
    <img src="atom.png" alt="" id="img">
    <div class="icons">
        <a href="../Profil_admin/my_view.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
        <a href="../dashboard/index.php"><i class="fa-solid fa-chart-line" style="color: #ffffff;"></i></a>
        <a href="../Admin/assets/phpScripts/deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ff0000;"></i></a>


    </div>
     <span>
            <?php  if(isset($res2['imageUrl'])) : ?>
                <img src="<?php echo "assets/admin_image/".$res2['imageUrl'];?>" alt="" >
            <?php endif ?>
        </span>
</header>

<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-1 pl-3 mt-3">
            <span class="pic pl-3 mt-5 ">
            <?php
            if (isset($res2['imageUrl']))
                echo "<img id='image' class='border border-primary border-5 rounded-circle'  height='100px' width='100px' border-style='solid' border-width='60px' src='../Admin/assets/admin_image/$res2[imageUrl]'>";
            ?>
            </span>
        </div>
        <div class="col-3 ml-n3 pt-2 pb-2">
            <h1 class="pb-6 font-weight-bold "><?php echo "$res2[familyName] $res2[firstName]"; ?></h1>
            <div class="manip">
                <form action="assets/phpScripts/change_image.php" method="post" enctype="multipart/form-data">

                    <label for="inputGroupFile04" class="form-labal">Changer photo de profil:<br></label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile04"
                               aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="img">
                        <button class="btn btn-primary" accept="image/*" type="submit" name="submit"
                                id="inputGroupFileAddon04"><i class="fa-solid fa-check"></i>Changer
                        </button>
                    </div>
                </form>
            </div>

        </div>
        <div class="col mt-5 mr-3">
        </div>
    </div>
</div>

</div>

<div class="container-fluid py-3 px-4">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link bg-primary text-white active rounded" id="nav-compte-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-compte" type="button" role="tab" aria-controls="nav-compte"
                    aria-selected="true"><i class="fa-solid fa-user"></i>Compte
            </button>
            <button class="nav-link bg-primary text-white" id="nav-mdp-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-mdp" type="button" role="tab" aria-controls="nav-profile"
                    aria-selected="false"><i class="fa-solid fa-key"></i>Mot de pass
            </button>
            
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-compte" role="tabpanel" aria-labelledby="nav-compte-tab">

            <section id="compte" class="section bg-light rounded px-4 py-4">
                <h1 class='mb-5'>Gestion de Compte</h1>
                <form action="assets/phpScripts/updateadmin.php" method="post">
                    <div class="inputs mb-4">
                        <div class="row ">
                            <div class="Name">
                                <label for="nom" class='form-label'>Nom:</label><br>
                                <input type="text" class='form-control' id="nom"
                                       name="nom" <?php echo "value='$res2[familyName]'"; ?> ><br>
                                <span class="error"></span>
                            </div>
                            <div class="Mail ">
                                <label for="mail" class='form-label'>Adresse email:</label><br>
                                <input type="mail" id="mail" class='form-control'
                                       name="email" <?php echo "value='$res2[email]'"; ?> >
                                <span class="error-form"></span>
                                <span class="error"></span>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="Prenom ">
                                <label for="prenom" class='form-label'>Prenom:</label><br>
                                <input type="text" id="prenom" class='form-control'
                                       name="prenom" <?php echo "value='$res2[firstName]'"; ?> ><br>
                                <span class="error"></span>
                            </div>
                            <div class="Adresse ">
                                <label for="adresse" class='form-label'>Adresse:</label><br>
                                <input type="text" id="adresse" class='form-control'
                                       name="adresse" <?php echo "value='$res2[address]'"; ?>><br>
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="buttons1 mb-3">
                        <button id="confirmer0" class='btn btn-primary' type="submit">Confirmer</button>
                        <button class='btn btn-secondary' id="butt2" type="reset">Annuler</button>
                    </div>
                </form>
                <div class="opreuss">
                    <?php
                    if (isset($_SESSION['opp_succes_update_profil']) && $_SESSION['opp_succes_update_profil'] == 1) {
                        echo "<h3>Operation reussite</h3>";
                        $_SESSION['opp_succes_update_profil'] = 0;
                    }
                    ?>
                </div>
            </section>

        </div>
        <div class="tab-pane fade" id="nav-mdp" role="tabpanel" aria-labelledby="nav-mdp-tab">

            <section id="gestepassword" class="section bg-light rounded px-4 py-4">
                <h1 id="title">Gestion de Mot de passe</h1>
                <form id="passwordform" action="assets/phpScripts/passwordinfo.php" method="post">
                    <div class="ancienPassword mb-4">
                        <label for="oldPass" class='form-label'>Ancien Mot de Passe:</label>
                        <input type="password" id="oldPass" name="oldpass" class='form-control'>
                        <span class="error-pass"></span>
                        <?php
                        if (isset($_SESSION['false_old_pass']) && $_SESSION['false_old_pass'] == 0) {
                            echo "<h6 style='color:red;'>Mot de passe incorrecte</h6>";
                            $_SESSION['false_old_pass'] = 1;
                        }
                        ?>
                    </div>
                    <div class="newPassword mb-2 ">
                        <label for="newPass" class='form-label'>Nouveau Mot de Passe:</label>
                        <input type="password" id="newPass" name="newpass" class='form-control'>
                        <span class="error-pass"></span>
                        <span class="samePass"></span>

                    </div>
                    <div class="newPassword mb-2">
                        <label for="confirmPass" class='form-label'>Confirmation de Mot de Passe:</label><br>
                        <input type="password" id="confirmPass" name="confirmpass" class='form-control'><br>
                        <span class="error-pass"></span>
                        <span class="form"></span>

                        <div class="erreur2"></div>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="reset" value="Annuler" class='btn btn-secondary ms-3'>Annuler</button>
                        <button type="submit" value="Confirmer" id="confirmerpass" class='btn btn-primary'>Confimer
                        </button>
                </form>
                <div class="opreuss">
                    <?php
                    if (isset($_SESSION['update_pass']) && $_SESSION['update_pass'] == 1) {
                        echo "<h3>Operation reussite</h3>";
                        $_SESSION['update_pass'] = 0;

                    }
                    ?>
                </div>
            </section>
        </div>
        

        </div>
       

        

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>

                    



