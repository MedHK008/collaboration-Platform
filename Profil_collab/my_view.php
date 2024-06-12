<?php
global $bdd;
session_start();
require('../Collab/assets/phpScripts/compteinfo.php');
require('../Collab/assets/phpScripts/competenceinfo.php');
require('../Collab/assets/phpScripts/projetsinfo.php');

if (!isset($_SESSION['id'])) 
{
 header('Location:../Collab/index.php');
 exit();
}


$reqQuestionProfile = "SELECT q.questionID, q.questionTitle, q.questionDescription , s.etat 
        FROM question q 
        JOIN collaborator c ON q.collaboratorID = c.collaboratorID 
        JOIN state s ON q.stateID = s.stateID
        WHERE c.collaboratorID = :id
        ORDER BY q.datePub DESC";


$stmtQuestionProfile = $bdd->prepare($reqQuestionProfile);
$stmtQuestionProfile->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$stmtQuestionProfile->execute();
$resQuestionsProfile = $stmtQuestionProfile->fetchAll(PDO::FETCH_ASSOC);

$reqFormation = "SELECT courseID, programTitle, tutor, online, endday FROM trainingprogram NATURAL JOIN signin WHERE collaboratorID = :collaboratorID";
$stmtFormation = $bdd->prepare($reqFormation);
$stmtFormation->bindParam(':collaboratorID', $_SESSION['id'], PDO::PARAM_INT);
$stmtFormation->execute();
$resFormation = $stmtFormation->fetchAll(PDO::FETCH_ASSOC);

function isEditable($stateTag)
{
    return $stateTag !== 'Résolue' && $stateTag !== 'Complète';
}

function hasEnded($endDate)
{
    $inputDate = strtotime($endDate);
    $currentDate = time();
    return ($currentDate >= $inputDate);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>
    <link href="../jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet">
    <link rel="stylesheet" href="header.css">

    <script>

        $(document).ready(function () {
            $(".resolueButton").click(function () {
                var questionID = $(this).data('question-id'); // Get the question ID from the data attribute

                $.ajax({
                    url: '../Collab/assets/phpScripts/setResolue.php', // URL of the PHP script
                    type: 'POST', // Use POST method
                    data: {
                        question_id: questionID // Data to be sent to the server
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {

                    }
                });
            });
        });

        $(document).ready(function () {
            $(".rollOutButton").click(function () {
                let courseID = $(this).data('course-id');

                $.ajax({
                    url: '../Collab/assets/phpScripts/rolloutCourse.php',
                    type: 'POST',
                    data: {
                        course_id: courseID
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });
        });

        $(document).ready(function () {
            $(".relancerButton").click(function () {
                var questionID = $(this).data('question-id');

                $.ajax({
                    url: '../Collab/assets/phpScripts/relancerQuestion.php',
                    type: 'POST',
                    data: {
                        question_id: questionID
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });
        });
        $(document).ready(function () {
            $(".deleteSeparateNotif").click(function () {
                var notificationID = $(this).data('notification-id');

                $.ajax({
                    url: '../Collab/assets/phpScripts/removeSeparateNotif.php',
                    type: 'POST',
                    data: {
                        notification_id: notificationID
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });
        });
        $(document).ready(function () {
            $(".deleteNotif").click(function () {

                $.ajax({
                    url: '../Collab/assets/phpScripts/removeNotif.php',
                    type: 'POST',
                    data: {
                    },
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });
        });
    </script>
</head>
<body>
<header>
    <img src="atom.png" alt="" id="img">
    <div class="icons">
        <a href="../Question/Accueil.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
        <a href="../Profil_collab/my_view.php"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
        <div class="dropdown-center">
            <a class="dropdown-toggle ms-3" data-bs-toggle="dropdown" aria-expanded="false"
               data-bs-auto-close="outside">
                <i class="fa-solid fa-bell" style="<?php if (isset($_SESSION['notification']) && $_SESSION['notification'] == 1) echo "color:#ffd700;"; else echo "color: #ffffff;"; ?>"></i>
            </a>
            <div class="dropdown-menu text-body-secondary" style="min-width: 400px;">
                <?php
                $req_notif = "SELECT notificationID, message, created_at FROM collabnotification NATURAL JOIN notifications WHERE collaboratorID = :collaboratorID ORDER BY created_at DESC";
                $stmtNotif = $bdd->prepare($req_notif);
                $stmtNotif->bindParam(':collaboratorID', $_SESSION['id'], PDO::PARAM_INT);
                $stmtNotif->execute();
                if ($stmtNotif->rowCount() == 0 )
                {
                    echo "<div class='dropdown-item py-3 rounded-3 text-center'> Pas de notifications </div><hr class='mt-1 mb-1'/>";
                    $_SESSION['notification'] = 0;
                }
                else
                {
                    $_SESSION['notification'] = 1;
                }

                $notifications = $stmtNotif->fetchAll(PDO::FETCH_ASSOC);

                foreach ($notifications as $notification) {
                    $formattedTime = (new DateTime($notification['created_at']))->format('Y-m-d H:i');
                    echo "<div class='dropdown-item py-3 rounded-3'> 
                            <div class='row me-1'> 
                                     <div class='col-12'><button type='button' class='float-end btn-close deleteSeparateNotif' data-notification-id = '".$notification['notificationID']."' aria-label='Close'></button><br>" . htmlspecialchars($notification['message']) . "</div> 
                                     <div class='col-12 text-end'>" . htmlspecialchars($formattedTime) . "
</div> 
                            </div> 
                          </div>
                            <hr class='mt-1 mb-1'/>";
                }
                ?>
                <div class="d-grid mt-2 me-2 ms-2 rounded-3">
                    <button class="btn btn-danger deleteNotif" type="button" <?php if ($_SESSION['notification'] == 0) echo "disabled"; ?> >
                        <i class="ms-4 fa-solid fa-trash"></i>

                    </button>
                </div>

            </div>

        </div>

        <a href="../Base_Connaisance/bc.php"><i class="fa-solid fa-book" style="color: #ffffff;"></i></a>
        <a href="../projects/projects.php"><i class="fa-solid fa-diagram-project" style="color: #ffffff;"></i></a>

        <a href="../Collab/assets/phpScripts/deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket"
                                                                 style="color: #dc3545;"></i></a>


    </div>
    <span>
            <?php if (isset($res8['imageUrl'])) : ?>
                <img src="<?php echo "../Collab/assets/collab_image/".$res8['imageUrl']; ?>" alt="" >
            <?php endif ?>
    </span>
</header>
<div class="container-fluid bg-light py-3">
    <div class="row">
        <div class="col-1 ms-3 pl-3 mt-3">
            <span class="pic pl-3 mt-5 ">
            <?php
            if (isset($res8['imageUrl']))
                echo "<img id='image' class='border border-primary border-5 rounded-circle'  height='100px' width='100px' border-style='solid' border-width='60px' src='../Collab/assets/collab_image/$res8[imageUrl]'>";
            ?>
            </span>
        </div>
        <div class="col-6 ml-n3 pt-2">
            <h1 class="pb-6 font-weight-bold "><?php echo "$res8[familyName] $res8[firstName]"; ?></h1>
            <div class="mt-3 pl-6">
                <h6 class='font-weight-light font-italic'><?php echo "$res8[speciality]"; ?></h6>
                <h6 class='font-weight-light'><a id="mail"
                                                 href="<?php echo "mailto:$res8[email]"; ?>"><?php echo "$res8[email] "; ?></a>
                </h6>

                <p class='font-weight-light'><?php echo $res8['birthDate']; ?></p>
            </div>
        </div>
        <div class="col mt-5 me-3">
            <div class="manip">
                <a href="#"><i class="fa-solid fa-message "></i>Messages</a>
                <a href="../Collab/gestionprofile.php#gesteskill" class="ms-1"><i class="fa fa-cog"></i>Parametres</a>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div id="aside0">
                <aside class="aside2 bg-light">
                    <table>
                        <tr>
                            <th colspan="2">Compétences</th>
                        </tr>

                        <?php
                        function niveauProgres($niveau)
                        {
                            if ($niveau == 'debutant') {
                                return 25;
                            } elseif ($niveau == 'intermediate') {
                                return 50;
                            } elseif ($niveau == 'expert') {
                                return 100;
                            } else {
                                return 0;
                            }
                        }


                        foreach ($comp as $row) {
                            $progress = niveauProgres($row['levelName']);
                            echo "<tr>
                    <td>{$row['skillName']}</td>
                    <td>
                        <div class='progress'>
                            <div class='progress-bar progress-bar-striped bg-primary' role='progressbar' style='width: {$progress}%' aria-valuenow='{$progress}' aria-valuemin='0' aria-valuemax='100'></div>
                        </div>
                    </td>
                  </tr>";
                        }
                        ?>

                    </table>
                </aside>
                <aside class="aside3 bg-light">
                    <table>
                        <tr>
                            <th>Projet</th>
                            <th>Role</th>
                        </tr>

                        <?php
                        foreach ($res4 as $row) {
                            echo "<tr><td>$row[projectTitle]</td><td>$row[rolename]</td></tr>";
                        }
                        ?>


                    </table>
                </aside>
                <aside class="aside2 bg-light">
                    <table>
                        <tr>
                            <th colspan="5">Formations</th>
                        </tr>
                        <tr>
                            <th>Titre</th>
                            <th>Formateur</th>
                            <th><i class="fa-solid fa-location-dot"></i></th>
                            <th>Date Fin</th>
                            <th>Sortir</th>
                        </tr>
                        <?php
                        foreach ($resFormation as $formation) {
                            $end = hasEnded($formation['endday']) ? "disabled" : "";
                            $endDate = hasEnded($formation['endday']) ? "Terminée" : $formation['endday'];
                            echo "<tr>
                                        <td>$formation[programTitle]</td>
                                        <td>$formation[tutor]</td>
                                        <td>$formation[online]</td>
                                        <td>" . $endDate . "</td>
                                        <td><button class='btn btn-danger align-content-center rollOutButton' id='rollOutButton' data-course-id ='" . $formation['courseID'] . "' " . $end . " > <i class='fas fa-sign-out'></i></button></td>                  
                                      </tr>";
                        }
                        ?>
                    </table>
                </aside>
            </div>
        </div>

        <div class="col-8 pt-3">
            <h1>Questions</h1>
            <?php foreach ($resQuestionsProfile as $index => $resQuestionProfile): ?>
                <div class="container bg-light rounded mb-3">
                    <div class="row px-1 py-1 mx-3 my-3">
                        <div class="col-12 mx-3 my-3">
                            <h1>
                                <a href='../Question/Accueil.php' style='text-decoration: none; color: black;'>
                                    <?php echo $resQuestionProfile['questionTitle']; ?>
                                </a>
                            </h1>
                            <p class='truncate'>
                                <?php echo $resQuestionProfile['questionDescription']; ?>
                            </p>
                            <span class="badge text-bg-primary"><?php echo $resQuestionProfile['etat']; ?></span>
                        </div>
                    </div>
                    <div class="col py-5 d-flex align-items-end flex-column">

                        <button class='btn btn-primary me-4' style='white-space:nowrap' data-bs-toggle="modal"
                                data-bs-target="#modifierModal-<?php echo $index; ?>"
                            <?php if (!isEditable($resQuestionProfile['etat'])) {
                                echo "disabled";
                            } ?>><i class="fas fa-edit"></i>Modifier
                        </button>

                        <button class='btn btn-success me-4 mt-2 resolueButton'
                                style='white-space:nowrap'
                                data-question-id="<?php echo $resQuestionProfile['questionID']; ?>"
                            <?php if (!isEditable($resQuestionProfile['etat'])) {
                                echo "disabled";
                            } ?>><i class="fa-solid fa-check"></i> Résolue
                        </button>

                        <?php if ($resQuestionProfile['etat'] === "Complète") {
                            echo "<button class='btn btn-danger me-4 mt-2 relancerButton' style = 'white-space:nowrap' data-question-id = '" . $resQuestionProfile['questionID'] . "'><i class='fas fa-redo'></i>Relance</button>";
                        } ?>

                        <div class='modal fade' id='modifierModal-<?php echo $index; ?>' tabindex='-1'
                             aria-labelledby='modifierModalLabel-<?php echo $index; ?>' aria-hidden='true'>
                            <div class='modal-dialog modal-xl'>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Veuillez modifier votre question</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action='../Collab/assets/phpScripts/updatequestion.php' method='post'>
                                            <input type="text" name="questionID"
                                                   value='<?php echo $resQuestionProfile['questionID']; ?>' hidden>
                                            <label class='form-label' for='titreQuestion'>Titre:</label>
                                            <input class='form-control mb-3' type='text' name='titreQuestion'
                                                   value='<?php echo htmlspecialchars($resQuestionProfile['questionTitle']); ?>'>
                                            <label class='form-label' for='tags'>Mots Clés:</label><br>
                                            <?php
                                            $selectedKeywordsQuery = "SELECT keyWord FROM keyword NATURAL JOIN questionkeyword WHERE questionID = :id";
                                            $stmtSelectedKeywords = $bdd->prepare($selectedKeywordsQuery);
                                            $stmtSelectedKeywords->bindParam(":id", $resQuestionProfile['questionID'], PDO::PARAM_INT);
                                            $stmtSelectedKeywords->execute();
                                            $selectedKeywords = $stmtSelectedKeywords->fetchAll(PDO::FETCH_COLUMN, 0);

                                            $sql = "SELECT * FROM keyword";
                                            $stmt = $bdd->prepare($sql);
                                            $stmt->execute();
                                            $resKeywords = $stmt->fetchAll();

                                            foreach ($resKeywords as $keywordIndex => $keyword):
                                                $keywordValue = htmlspecialchars($keyword['keyWord']);
                                                $checked = in_array($keywordValue, $selectedKeywords) ? 'checked' : '';
                                                ?>
                                                <input type="checkbox" class="btn-check"
                                                       id="btn-check-<?php echo $index; ?>-<?php echo $keywordIndex; ?>"
                                                       name="tags[]"
                                                       value="<?php echo $keywordValue; ?>" <?php echo $checked; ?>
                                                       autocomplete="off">
                                                <label class="btn btn-primary rounded"
                                                       for="btn-check-<?php echo $index; ?>-<?php echo $keywordIndex; ?>"><?php echo $keywordValue; ?></label>
                                            <?php endforeach; ?>
                                            <br>
                                            <label class='mt-3 mb-0 form-label' for='Description'>Description:</label>
                                            <textarea class='mt-0 pt-0 jqte-test'
                                                      name='descriptionQuestion'><?php echo htmlspecialchars($resQuestionProfile['questionDescription']); ?></textarea>
                                            <input type="hidden" name="questionID"
                                                   value="<?php echo $resQuestionProfile['questionID']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Annuler
                                        </button>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script>
    $('.jqte-test').jqte();

    // settings of status
    var jqteStatus = true;
    $(".status").click(function () {
        jqteStatus = !jqteStatus;
        $('.jqte-test').jqte({"status": jqteStatus})
    });
</script>
</body>
</html>

