<?php
    require_once("assets/phpScripts/connect.php");
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
        exit;
    }
    require('assets/phpScripts/competenceinfo.php');
    require('assets/phpScripts/projetsinfo.php');
    require('assets/phpScripts/compteinfo.php');
?>
<!DOCTYPE html>
<html lang="en">
<>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile-modification</title>
    <link rel="stylesheet" href="assets/css/sidemenu.css">
    <link rel="stylesheet" href="assets/css/compte.css">
    <link rel="stylesheet" href="assets/css/password.css">
    <link rel="stylesheet" href="assets/css/Projets.css">
    <link rel="stylesheet" href="assets/css/Competence.css">
    <script src="assets/js/index.js" async></script>
    <script src="assets/js/password.js" async></script>
    <script src="assets/js/competence.js" async></script>
    <script src="assets/js/projects.js" async></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .opreuss{
            display: flex;
            justify-content: center;
            color: green;
        }
        #falsepass{
            color:red;
        }
      
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="sidenav">
            <div class="board">
                <div class="center">
                    <span class="picture">
                    <form action="assets/phpScripts/change_image.php" method="post" enctype="multipart/form-data">
                        <?php
                            if(isset($res8['imageUrl']))
                            {   
                                echo"<img class='img'src='assets/collab_image/$res8[imageUrl]' alt='photo de profil'>";
                            }
                        ?>
                        
                        <input type="file" accept="image/*" name="img" id="uploadImg">
                        <label for="uploadImg" id="uploadImgLabel"><i class="fa-solid fa-arrow-up-from-bracket"></i>Upload Image</label>
                        <button type="submit" name="submit"><i class="fa-solid fa-check"></i>Changer</button>
                        </form>
                    </span>
                </div>            
                <div class="buttons">
                    <a href="#gestecompte"><button id="compte"><i class="fa-solid fa-user"></i>Compte</button></a><br>
                    <a href="#gestepassword"><button id="password"><i class="fa-solid fa-key"></i>Mot de Passe</button></a><br>
                    <a href="#gesteskill"><button id="competences"><i class="fa-solid fa-star"></i>Compétences</button></a><br>
                    <a href="#gesteprojects"><button id="projets"><i class="fa-solid fa-handshake"></i>Projets</button></a><br>
                </div>
            </div>
        </div>
        <div class="main-content">
            <section id="gestecompte" class="section">
                <h1 id="title">Gestion du compte</h1>
                <form id="myForm" action="assets/phpScripts/updatecollab.php" method="post" >
                    <div>
                        <label for="nom">Nom:</label>
                        <input type="text" id="nom" <?php  echo"value='$res8[familyName]'";  ?> name="nom"><br>
                        <span class="error"></span>
                    </div>
                    <div>
                        <label for="prenom">Prenom:</label>
                        <input type="text" id="prenom" <?php  echo"value='$res8[firstName]'";  ?>  name="prenom"><br>
                        <span class="error"></span>
                    </div>
                    <div>
                        <label for="dateNaissance">Date de naissance:</label>
                        <input type="date" id="dateNaissance" <?php  echo"value='$res8[birthDate]'";  ?> name="dateNaissance"><br>
                        <span class="error"></span>
                    </div>
                    <div>
                        <label for="cin">CIN:</label>
                        <input type="text" id="cin" <?php  echo"value='$res8[cin]'";  ?> name="cin"><br>
                        <span class="error-form"></span>
                        <span class="error"></span>
                        

                    </div>
                    <div>
                        <label for="email">Adresse email:</label>
                        <input type="email" id="email" <?php  echo"value='$res8[email]'";  ?> name="email"><br>
                        <span class="error-form"></span>
                        <span class="error"></span>
                    </div>
                    <div>
                        <label for="adresse">Adresse:</label>
                        <input type="text" id="adresse" <?php  echo"value='$res8[address]'";  ?> name="adresse"><br>
                        <span class="error"></span>
                    </div>
                    <div>
                        <label for="specialite">Spécialité:</label>
                        <input type="text" <?php  echo"value='$res8[speciality]'";  ?> id="specialite" name="specialite"><br>
                        <span class="error"></span>
                    </div>
                    <input type="reset" value="Annuler">
                    <input type="submit" value="Confirmer" id="confirmer">
                </form>
                <div class="opreuss">
                <?php
                    if(isset( $_SESSION['opp_succes_update_profil']) &&  $_SESSION['opp_succes_update_profil']==1){
                        echo"<h3>Operation reussite</h3>";
                        $_SESSION['opp_succes_update_profil']=0;
                    }
                ?>
                </div>
            </section>
            <section id="gestepassword" class="section">
                <h1 id="title">Gestion de Mot de passe</h1>
                <form id="passwordform" action="assets/phpScripts/passwordinfo.php" method="post" >
                <div class="ancienPassword">
                    <label for="oldPass">Ancien Mot de Passe</label><br>
                    <input type="password" id="oldPass" name="oldpass"><br>
                    <span class="error-pass"></span>
                    <?php
                        if(isset($_SESSION['false_old_pass']) && $_SESSION['false_old_pass']==0)
                        {
                            echo"<h6 id='falsepass'>Mot de passe incorrecte</h6>";
                            $_SESSION['false_old_pass']=1;
                        }
                    ?>
                </div>
                <div class="newPassword">
                    <label for="newPass">Nouveau Mot de Passe</label><br>
                    <input type="password" id="newPass" name="newpass"><br>
                    <span class="error-pass"></span><br>
                    <span class="samePass"></span>

                </div>
                <div class="newPassword">
                    <label for="confirmPass">Confirmation de Mot de Passe</label><br>
                    <input type="password" id="confirmPass" name="confirmpass"><br>
                    <span class="error-pass"></span>
                    <span class="form"></span>

                    <div class="erreur2"></div>
                </div>
                    <input type="reset" value="Annuler">
                    <input type="submit" value="Confirmer" id="confirmerpass">
                </form>
                <div class="opreuss">
                <?php
                    if(isset( $_SESSION['update_pass']) &&  $_SESSION['update_pass']==1){
                        echo"<h3>Operation reussite</h3>";
                        $_SESSION['update_pass']=0;

                    }
                ?>
                </div>
            </section>
            <section id="gesteskill" class="section">
                <h1 id="title">Gestion des competences</h1>
                <div class="table">
                    <table id="skillTable">
                        <tr>
                            <th>comptence</th><th>Niveau</th><th>Description</th><th>modifier</th><th>supprimer</th>
                        </tr>
                            <?php 
                            
                                foreach($comp as $line)
                                {
                                    echo "<tr><td>$line[skillName] </td><td>$line[levelName]</td><td>$line[skillDescription]</td>";
                            ?>
                            <td><a href="newfile.php">
                            <img src="./assets/img/penIcon.png" alt="Icon">
                            </a></td>
                            <td>
                                <a href="newfile.php">
                                <img src="./assets/img/trashIcon.png" alt="Icon">
                            </a>
                            </td>
                            </tr>
                            <?php
                                }
                            ?>
                    </table>
                </div>
                <form id="skillform" method="post" action='assets/phpScripts/addskill.php'>
                    <div>
                        <label for="competence">competence:</label>
                        <select  id="competence" name="competence">
                        <option></option>

                            <?php  
                                foreach($res10 as $skill)
                                    echo "<option value=$skill[skillName]>$skill[skillName]</option>";
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="Description">Description:</label>
                        <input type="text" id="Description" name="Description">
                    </div>
                    <div>
                        <label for="level">niveau:</label>
                        <select id="level" name="level">
                            <option></option>
                            <?php  
                                foreach($res11 as $level)
                                    echo "<option value=$level[levelName]>$level[levelName]</option>";
                            ?>
                        </select>
                    </div>
                    <input type="reset" value="Annuler">
                    <input type="submit" value="Confirmer" id="confirmer2">
                </form>
            </section>
            <section id="gesteprojects" class="section">
                <h1 id="title">Gestion des projets</h1>
                <div class="table">
                    <table id="projectTable">
                        <tr>
                            <th>Projet</th><th>Role</th><th>modifier</th><th>supprimer</th>
                        </tr>
                        <?php 
                            
                            foreach($res4 as $line)
                            {
                                echo "<tr> <td> $line[projectTitle] </td><td> $line[rolename] </td><td><a href='newfile.php'>
                                <img src='./assets/img/penIcon.png' alt='Icon'>
                                </a></td> <td>
                                <a href='newfile.php'>
                                <img src='./assets/img/trashIcon.png' alt='Icon'>
                            </a>
                            </td></tr>";
                        ?>
                        
                       
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
                <form id="projectform" action="assets/phpScripts/addprojectrole.php" method="post">
                    <div>
                        <label for="projet">Projet:</label>
                        <select  id="projet" name="project">
                        <option></option>
                            <?php  
                                foreach($res5 as $project)
                                    echo "<option value='$project[projectTitle]'>$project[projectTitle]</option>";
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="role">Role:</label>
                        <select  id="role" name="roles">
                        <option></option>
                            <?php  
                                foreach($res6 as $role)
                                    echo "<option value='$role[rolename]'>$role[rolename]</option>";
                            ?>
                        </select>
                    </div>
                    
                    
                    <input type="reset" value="Annuler">
                    <input type="submit" value="Confirmer" id="confirmer3">
                </form>
            </section>
        </div>
    </div>
</body>
</html>