<?php
require('../Admin/assets/phpScripts/connect.php');
session_start();
require('../Admin/assets/phpScripts/compteinfo.php');


$questionreq = "SELECT questionID, datePub, questionTitle, firstName, familyName FROM question NATURAL JOIN collaborator";
$stmtQuestions = $bdd->prepare($questionreq);
$stmtQuestions->execute();
$questions = $stmtQuestions->fetchAll(PDO::FETCH_ASSOC);


require('../Admin/assets/phpScripts/collabinfo.php');
require('../Admin/assets/phpScripts/skillinfo.php');
require('../Admin/assets/phpScripts/projectinfo.php');
require('../Admin/assets/phpScripts/demandeinfo.php');

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
    <link rel="stylesheet" href="my_view.css">
    <title>Profil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="my_view.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="header.css">

</head>
<body>
<header>
    <?php
    if (!isset($_SESSION['id'])) {
        header('Location:../Admin/index.php');
        exit();
    }
    ?>
    <img src="atom.png" alt="" id="img">
    <div class="icons">
        <a href="../Profil_admin/my_view.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
        <a href="../dashboard/index.php"><i class="fa-solid fa-chart-line" style="color: #ffffff;"></i></a>
        <a href="../Admin/assets/phpScripts/deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket"
                                                                style="color: #ff0000;"></i></a>
    </div>
    <span>
        <?php if (isset($res2['imageUrl'])) : ?>
            <img src="<?php echo "../Admin/assets/admin_image/".$res2['imageUrl']; ?>" alt="">
        <?php endif ?>
        </span>
</header>

<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-1 ps-3 mt-3">
                <span class="pic ps-3 mt-5 ">
                    <?php
                    if (isset($res2['imageUrl']))
                        echo "<img id='image' class='border border-primary border-5 rounded-circle'  height='100px' width='100px' border-style='solid' border-width='60px' src='../Admin/assets/admin_image/$res2[imageUrl]'>";
                    ?>
                </span>
        </div>
        <div class="col-4 ml-n3 pt-2">
            <h1 class="pb-7 font-weight-bold ms-2"><?php echo "$res2[familyName] $res2[firstName]"; ?></h1>
            <div class="mt-3">
                <h6 class='font-weight-light ms-2'><a id="mail"
                                                 href="<?php echo "mailto:$res2[email]"; ?>"><?php echo "$res2[email] "; ?></a>
                </h6>

                <p class='font-weight-light ms-1'>0669694420</p>
            </div>
        </div>
        <div class="col me-3 ">
            <div class="manip float-right py-5">
                <a href="#"><i class="fa-solid fa-message"></i>Messages</a>
                <a href="../Admin/gestionprofile.php" class="ms-1"><i class="fa fa-cog"></i>Parametres</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid py-3 px-4">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link bg-primary text-white active " id="nav-question-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-question" type="button" role="tab" aria-controls="nav-question"
                    aria-selected="true"><i class="fa-solid fa-clipboard-question"></i>Questions
            </button>
            <button class="nav-link bg-primary text-white" id="nav-formation-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-formation" type="button" role="tab" aria-controls="nav-formation"
                    aria-selected="false"><i class="fa-solid fa-book-open"></i>Formations
            </button>
            <button class="nav-link bg-primary text-white" id="nav-event-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-event" type="button" role="tab" aria-controls="nav-event"
                    aria-selected="false"><i class="fa-solid fa-calendar-days"></i>Événements
            </button>
            <button class="nav-link bg-primary text-white" id="nav-competence-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-competence" type="button" role="tab" aria-controls="nav-contact"
                    aria-selected="false"><i class="fa-solid fa-star"></i>Competences
            </button>
            <button class="nav-link bg-primary text-white" id="nav-projet-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-projet" type="button" role="tab" aria-controls="nav-projet"
                    aria-selected="false"><i class="fa-solid fa-handshake"></i>Projets
            </button>
            <button class="nav-link bg-primary text-white" id="nav-collab-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-collab" type="button" role="tab" aria-controls="nav-collab"
                    aria-selected="false"><i class="fa-solid fa-people-group"></i>Collaborateurs
            </button>
            <button class="nav-link bg-primary text-white" id="nav-demande-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-demande" type="button" role="tab" aria-controls="nav-demande"
                    aria-selected="false"><i class="fa-solid fa-reply"></i>Demandes
            </button>
        </div>
    </nav>
    <div class="container-fluid my-3 mx-3">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-question" role="tabpanel" aria-labelledby="nav-question-tab">
                <section id="question" class="section bg-light rounded px-4 py-4">
                    <div class=" px-3 py-3 bg-light rounded-2 me-3">
                        <h1>Modération des questions:</h1>
                        <table class="table table-hover table-bordered rounded-5 table-hover mt-3 text-center">
                            <tr>
                                <th>QuestionID</th>
                                <th>Titre</th>
                                <th>Date Publication</th>
                                <th>Publié(e) par:</th>
                                <th>Supprimer</th>
                            </tr>
                            <?php foreach ($questions as $question) : ?>
                                <tr>
                                    <td><?php echo $question['questionID']; ?></td>
                                    <td><?php echo $question['questionTitle'] ?></td>
                                    <td><?php echo $question['datePub'] ?></td>
                                    <td><?php echo $question['firstName'] . " " . $question['familyName']; ?></td>
                                    <td><a class="btn btn-danger"
                                           href="../Admin/assets/phpScripts/deleteQuestion.php?id=<?php echo $question['questionID']; ?>"><i
                                                    class="fa-solid fa-trash ps-2"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="nav-formation" role="tabpanel" aria-labelledby="nav-formation-tab">
                <div id="formation" class="section bg-light px-4 py-4">
                    <div class="px-3 py-3 bg-light rounded-2 me-3">
                        <h1>Modération des formations:</h1>
                        <table class="table table-hover table-bordered rounded-5 table-hover mt-3 text-center">
                        <tr>
                            <th>formationID</th>
                            <th>Titre de formation</th>
                            <th>Tuteur de formation</th>
                            <th>Date de publication</th>
                            <th>Date fin</th>
                            <th>Supprimer</th>
                        </tr>
                            <?php
                            $stmtFormations = $bdd->prepare("SELECT courseID, programTitle, tutor, publicationDate, endday FROM trainingprogram");
                            $stmtFormations->execute();
                            $formations = $stmtFormations->fetchAll();
                            foreach ($formations as $formation) {
                                echo "<tr><td>".$formation['courseID']."</td><td>".$formation['programTitle']."</td><td>".$formation['tutor']."</td><td>".$formation['publicationDate']."</td><td>".$formation['endday']."</td><td><a class='btn btn-danger' href='../Admin/assets/phpScripts/deleteFormation.php?id=".$formation['courseID']."'><i class='fa-solid fa-trash ps-2'></i></a></td></tr>";
                            }
                            ?>    
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-event" role="tabpanel" aria-labelledby="nav-event-tab">
                <div id="event" class="section bg-light px-4 py-4">
                    <div class = "px-3 py-3 bg-light rounded-2 me-3">
                        <h1>Modération des événements:</h1>
                        <table class="table table-hover table-bordered rounded-5 mt-3 text-center">
                            <tr>
                                <th>ÉvénementID</th>
                                <th>Titre d'événement</th>
                                <th>Description d'événement</th>
                                <th>Date de publication</th>
                                <th><i class="fa-solid fa-location-dot"></i></th>
                                <th>Supprimer</th>
                            </tr>
                            <?php
                            $stmtEvents = $bdd->prepare("SELECT eventID, publicationDate, place, eventTitle, eventDescription from event");
                            $stmtEvents->execute();
                            $events = $stmtEvents->fetchAll();
                            ?>
                            <?php foreach ($events as $event) : ?>
                            <tr>
                                <td><?php echo $event['eventID'];?></td>
                                <td><?php echo $event['eventTitle'];?></td>
                                <td><?php echo $event['eventDescription'];?></td>
                                <td><?php echo $event['publicationDate'];?></td>
                                <td><?php echo $event['place'];?></td>
                                <td><a class="btn btn-danger"
                                       href="../Admin/assets/phpScripts/deleteEvent.php?id=<?php echo $event['eventID']; ?>"><i
                                                class="fa-solid fa-trash ps-2"></i></a></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                </div>
            </div>
            </div>
            <div class="tab-pane fade" id="nav-competence" role="tabpanel" aria-labelledby="nav-competence-tab">


                <section id="Competences" class="section bg-light rounded px-4 py-4">
                    <h1>Gestion des Compétences</h1>
                    <table id="compe" class='table table-hover table-bordered rounded mb-5 mt-5 text-center'>
                        <tr>
                            <th>Identifiant</th>
                            <th>Competences</th>
                            <th>Description</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php
                        foreach ($skills as $row) {
                            echo "<tr>";
                            echo "<td>$row[skillID]</td>";
                            echo "<td>$row[skillName]</td>";
                            echo "<td>$row[skillDescription]</td>";
                            echo "<td><a href=\"../Admin/assets/phpScripts/deleteSkill.php?id=$row[skillID]\">
                                     <i class=\"fa-solid fa-skull-crossbones\"></i>
                                     </a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    <form action="../Admin/assets/phpScripts/addSkill.php" method="post">
                        <div class="inputs2">
                            <div class="row4 mb-3">
                                <div class="Prenom" id="collab-pre">
                                    <label for="Competence" class='form-label'>Compétence:</label><br>
                                    <input type="text" id="Competence" name="Competence" class='form-control'>
                                </div>
                            </div>
                            <div class="row4">
                                <div class="Prenom mb-3" id="des">
                                    <label for="description" class='form-label'>Description:</label><br>
                                    <input type="text" id="description" name="description" class='form-control'>
                                </div>
                            </div>
                        </div>
                        <div class="buttons1 mb-3">
                            <button id="confirmer3" class='btn btn-primary' type="submit">Ajouter</button>
                            <button id="butt2" type="reset" class='btn btn-secondary'>Annuler</button>
                        </div>
                    </form>
                </section>

            </div>
            <div class="tab-pane fade" id="nav-projet" role="tabpanel" aria-labelledby="nav-projet-tab">

                <section id="Projects" class="section bg-light rounded px-4 py-4">
                    <h1>Gestion de Projets</h1>
                    <table id="projet" class='table table-hover table-bordered rounded mt-5 mb-5 text-center'>
                        <tr>
                            <th>Identifiant</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Date de debut</th>
                            <th>Date de fin</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php
                        foreach ($projects as $row) {
                            echo "<tr>";
                            echo "<td>$row[projectID]</td>";
                            echo "<td>$row[projectTitle]</td>";
                            echo "<td>$row[projectDescription]</td>";
                            echo "<td>$row[startDate]</td>";
                            echo "<td>$row[endDate]</td>";
                            echo "<td><a href=\"../Admin/assets/phpScripts/deleteProject.php?id=$row[projectID]\">
                                         <i class=\"fa-solid fa-skull-crossbones\"></i>
                                         </a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    <form action="../Admin/assets/phpScripts/addproject.php" method="post">
                        <div class="inputs">
                            <div class="row">
                                <div class="Name mb-3">
                                    <label for="titre" class='form-label'>Titre:</label><br>
                                    <input type="text" id="titre" name="titre" class='form-control'>
                                </div>
                                <div class="Mail mb-3">
                                    <label for="debut" class='form-label'>Date de début:</label><br>
                                    <input type="date" id="debut" name="debut" class='form-control'>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="Prenom mb-3">
                                    <label for="desc" class='form-label'>Description:</label><br>
                                    <input type="text" id="desc" name="desc" class='form-control'>
                                </div>
                                <div class="Cin mb-3">
                                    <label for="chef" class='form-label'>Date de fin:</label><br>
                                    <input type="date" id="fin" name="fin" class='form-control'>
                                </div>
                            </div>
                        </div>
                        <div class="buttons1">
                            <button id="confirmer4" class='btn btn-primary' type="submit">Ajouter</button>
                            <button class='btn btn-secondary' id="butt2" type="reset">Annuler</button>
                        </div>
                    </form>
                </section>
            </div>
            <div class="tab-pane fade" id="nav-collab" role="tabpanel" aria-labelledby="nav-collab-tab">
                <section class='llab section rounded bg-light px-4 py-4'>
                    <h1>Gestion de Collaborateurs</h1>
                    <table id="collab" class='table table-hover table-bordered rounded mt-5 mb-5 text-center'>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php
                        foreach ($res3 as $row) {
                            echo "<tr>";
                            echo "<td>$row[collaboratorID]</td>";
                            echo "<td>$row[firstName]</td>";
                            echo "<td>$row[familyName]</td>";
                            echo "<td>$row[email]</td>";
                            echo "<td>$row[password]</td>";
                            echo "<td><a href=\"../Admin/assets/phpScripts/deleteCollab.php?id=$row[collaboratorID]\">
                                     <i class=\"fa-solid fa-skull-crossbones\"></i>
                                     </a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    <form action="../Admin/assets/phpScripts/addcollab.php" method="post">
                        <div class="inputs">
                            <div class="row">
                                <div class="Name">
                                    <label for="nom" class='form-label'>Nom:</label><br>
                                    <input type="text" id="nom" name="nom" class='form-control'><br>
                                </div>
                                <div class="Mail">
                                    <label for="mail" class='form-label'>Adresse email:</label><br>
                                    <input type="text" id="mail" name="email" class='form-control'><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="Prenom">
                                    <label for="prenom" class='form-label'>Prenom:</label><br>
                                    <input type="text" id="prenom" name="prenom" class='form-control'><br>
                                </div>
                            </div>
                        </div>
                        <div class="buttons1">
                            <button class='btn btn-primary' id="confirmer2" type="submit">Ajouter</button>
                            <button id="butt2" type="reset" class='btn btn-secondary'>Annuler</button>
                        </div>
                    </form>
                </section>
            </div>

            <div class="tab-pane fade" id="nav-demande" role="tabpanel" aria-labelledby="nav-demande-tab">

                <section id="demandes" class='section bg-light rounded px-4 py-4'>
                    <h1>Gestion de Demandes</h1>
                    <table id="demande" class='table table-hover table-bordered rounded mt-5 mb-5 text-center'>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Email</th>
                            <th>Accepter</th>
                            <th>Refuser</th>
                        </tr>
                        <?php
                        foreach ($demandeur as $row) {
                            echo "<tr>";
                            echo "<td>$row[demandeID]</td>";
                            echo "<td>$row[name]</td>";
                            echo "<td>$row[familyname]</td>";
                            echo "<td>$row[email]</td>";
                            echo "<td><a href=\"../Admin/assets/phpScripts/accept.php?id=$row[demandeID]\">
                                     <i class=\"fa-solid fa-check\"></i>
                                     </a></td>";
                            echo "<td><a href=\"../Admin/assets/phpScripts/refuse.php?id=$row[demandeID]\">
                                     <i class=\"fa-solid fa-x\"></i>
                                     </a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </section>
            </div>

        </div>
    </div>

</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var hash = window.location.hash;
        if (hash) {
            var targetTab = document.querySelector('button[data-bs-target="' + hash + '"]');
            if (targetTab) {
                var activeTab = document.querySelector('.nav-link.active');
                var activePane = document.querySelector('.tab-pane.show.active');
                if (activeTab) activeTab.classList.remove('active');
                if (activePane) activePane.classList.remove('show', 'active');
                targetTab.classList.add('active');
                document.querySelector(hash).classList.add('show', 'active');
            }
        }
    });
</script>
</body>
</html>
