<?php
require_once("assets/phpScripts/connect.php");
session_start();
require('assets/phpScripts/competenceinfo.php');
require('assets/phpScripts/projetsinfo.php');
require('assets/phpScripts/compteinfo.php');
if (!isset($_SESSION['id'])) 
{
 header('Location:../Collab/index.php');
 exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parametres du profil</title>
    <script src="assets/js/index.js" async></script>
    <script src="assets/js/password.js" async></script>
    <script src="assets/js/competence.js" async></script>
    <script src="assets/js/projects.js" async></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="gestionprofile.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/css/header.css">
</head>
<body>
<header>
    <img src="atom.png" alt="" id="img">
    <div class="icons">
        <a href="../Question/Accueil.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
        <a href="../Profil_collab/my_view.php"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
        <i class="fa-solid fa-bell" style="color: #ffffff;"></i>
        <a href="../Base_Connaisance/bc.php"><i class="fa-solid fa-book" style='color: #ffffff;'></i></a>
        <a href="../projects/projects.php"><i class="fa-solid fa-diagram-project" style="color: #ffffff;"></i></a>
        <a href="../Collab/assets/phpScripts/deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #dc3545;"></i></a>
    </div>
    <span>
            <?php if (isset($res8['imageUrl'])) : ?>
                <img src="<?php echo "../Collab/assets/collab_image/".$res8['imageUrl']; ?>" alt="" >
            <?php endif ?>
    </span>
</header>

<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-1 pl-3 mt-3">
            <span class="pic pl-3 mt-5 ">
            <?php
            if (isset($res8['imageUrl']))
                echo "<img id='image' class='border border-primary border-5 rounded-circle'  height='100px' width='100px' border-style='solid' border-width='60px' src='../Collab/assets/collab_image/$res8[imageUrl]'>";
            ?>
            </span>
        </div>
        <div class="col-3 ml-n3 pt-2 pb-2">
            <h1 class="pb-6 font-weight-bold "><?php echo "$res8[familyName] $res8[firstName]"; ?></h1>
            <div class="manip">
                <form action="assets/phpScripts/change_image.php" method="post" enctype="multipart/form-data">

                    <label for="inputGroupFile04" class="form-labal">Changer photo de profil:<br></label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile04"
                               aria-describedby="inputGroupFileAddon04" aria-label="Upload">
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
            <button class="nav-link bg-primary text-white" id="nav-competence-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-competence" type="button" role="tab" aria-controls="nav-contact"
                    aria-selected="false"><i class="fa-solid fa-star"></i>Competences
            </button>
            <button class="nav-link bg-primary text-white" id="nav-projet-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-projet" type="button" role="tab" aria-controls="nav-projet"
                    aria-selected="false"><i class="fa-solid fa-handshake"></i>Projets
            </button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-compte" role="tabpanel" aria-labelledby="nav-compte-tab">

            <section id="gestecompte" class="section bg-light rounded px-4 py-4">
                <h1 id="title">Gestion du compte</h1>
                <form id="myForm" action="assets/phpScripts/updatecollab.php" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nom et Prenom:</span>
                        <input type="text" aria-label="First name" name="nom"
                               <?php echo "value='$res8[familyName]'"; ?>class="form-control">
                        <input type="text" aria-label="Last name" name="prenon"
                               <?php echo "value='$res8[firstName]'"; ?>class="form-control"> <br> <span
                                class="error"></span>
                    </div>
                    <div class='row mb-3'>
                        <div class='col-6'>
                            <div class="input-group">
                                <span class="input-group-text">Date de naissance:</span>
                                <input type="date" id="dateNaissance" <?php echo "value='$res8[birthDate]'"; ?>
                                       name="dateNaissance" class='form-control'><br>
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class='col-6 '>
                            <div class="input-group">
                                <span class="input-group-text">CIN:</span>
                                <input type="text" class="form-control" id="cin" <?php echo "value='$res8[cin]'"; ?>
                                       name="cin"><br>
                                <span class="error-form"></span>
                                <span class="error"></span>


                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Adresse Email:</span>
                        <input type="email" id="email" <?php echo "value='$res8[email]'"; ?> name="email"
                               class='form-control'><br>
                        <span class="error-form"></span>
                        <span class="error"></span>
                    </div>
                    <div class='input-group mb-3'>
                        <span class='input-group-text'>Adresse:</span>
                        <input type="text" id="adresse" <?php echo "value='$res8[address]'"; ?> name="adresse"
                               class='form-control'><br>
                        <span class="error"></span>
                    </div>
                    <div class='input-group mb-3'>
                        <span class="input-group-text">Spécialité:</span>
                        <input type="text" <?php echo "value='$res8[speciality]'"; ?> id="specialite" name="specialite"
                               class="form-control"><br>
                        <span class="error"></span>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="reset" class='btn btn-secondary ms-3' value="Annuler">Annuler</button>
                        <button type="submit" class='btn btn-primary' value="Confirmer" id="confirmer">Confirmer
                        </button>
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
                            echo "<h6 id='falsepass'>Mot de passe incorrecte</h6>";
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
        <div class="tab-pane fade" id="nav-competence" role="tabpanel" aria-labelledby="nav-competence-tab">
        <div id="geteskill">
            <section id="gesteskill" class="section bg-light rounded px-4 py-4">
                <h1 id="title">Gestion des competences</h1>
                <div class="table">
                    <table id="skillTable" class='table table-hover table-bordered rounded mb-5 text-center'>
                        <tr>
                            <th>Comptence</th>
                            <th>Niveau</th>
                            <th>Description</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php

                        foreach ($comp as $line) {
                            echo "<tr><td>$line[skillName] </td><td>$line[levelName]</td><td>$line[skillDescription]</td>";
                            ?>
                            <td><a href="newfile.php">
                                    <img src="./assets/img/penIcon.png" alt="Icon" width="20px" height="20px">
                                </a></td>
                            <td>
                                <a href="newfile.php">
                                    <img src="./assets/img/trashIcon.png" alt="Icon" width="25px" height="25px">
                                </a>
                            </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <form id="skillform" method="post" action='assets/phpScripts/addskill.php'>
                    <div class='row mb-3'>
                        <div class='col-6'>

                            <label for="competence" class='form-label'>Competence:</label>
                            <select id="competence" name="competence" class='form-select '>
                                <option selected>Choisir une competence</option>

                                <?php
                                foreach ($res10 as $skill)
                                    echo "<option value=\"{$skill['skillName']}\">{$skill['skillName']}</option>";
                                ?>
                            </select>
                        </div>
                        <div class='col-6'>
                            <label for="level" class='form-label'>Niveau:</label>
                            <select id="level" name="level" class='form-select' aria-label="Default select example">
                                <option selected>Choisir un niveau</option>
                                <?php
                                foreach ($res11 as $level)
                                    echo "<option value=$level[levelName]>$level[levelName]</option>";
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class='mb-3'>
                        <label for="Description" class='form-label'>Description:</label>
                        <textarea class='form-control' type="text" id="Description" name="Description"
                                  rows="3"></textarea>
                    </div>
                    <div class="d-flex flex-row-reverse">
                        <button type="reset" value="Annuler" class='btn btn-secondary ms-3'>Annuler</button>
                        <button type="submit" value="Confirmer" id="confirmer2" class='btn btn-primary '>Confirmer
                        </button>
                    </div>
                </form>
            </section>
        </div>
        </div>
        <div class="tab-pane fade" id="nav-projet" role="tabpanel" aria-labelledby="nav-projet-tab">

            <section id="gesteprojects" class="section bg-light rounded px-4 py-4">
                <h1 id="title">Gestion des projets</h1>
                <div class="table">
                    <table id="projectTable" class='table table-hover table-bordered text-center mb-5 rounded'>
                        <tr>
                            <th>Projet</th>
                            <th>Role</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php
                        foreach ($res4 as $line) {
                            echo "<tr> <td> $line[projectTitle] </td><td> $line[rolename] </td><td>
                                <a href='assets/phpScripts/deleteRole.php'>
                                <img src='./assets/img/trashIcon.png' alt='Icon' width='27px' height='27px'>
                            </a>
                            </td></tr>";
                            ?>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <form id="projectform" action="assets/phpScripts/addprojectrole.php" method="post">
                    <div class='row mb-3'>
                        <div class='col-6'>
                            <label for="projet" class='form-label'>Projet:</label>
                            <select id="projet" name="project" class='form-select'>
                                <option selected>Choisir un projet</option>
                                <?php
                                foreach ($res5 as $project)
                                    echo "<option value='$project[projectTitle]'>$project[projectTitle]</option>";
                                ?>
                            </select>
                        </div>
                        <div class='col-6'>
                            <label for="role" class='form-label'>Role:</label>
                            <select id="role" name="roles" class='form-select'>
                                <option selected>Choisir le role</option>
                                <?php
                                foreach ($res6 as $role)
                                    echo "<option value='$role[rolename]'>$role[rolename]</option>";
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="d-flex flex-row-reverse">
                        <button type="reset" value="Annuler" class='btn btn-secondary ms-3'>Annuler</button>
                        <button type="submit" value="Confirmer" id="confirmer3" class='btn btn-primary'>Confirmer
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
