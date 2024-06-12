<?php
global $res8;
require_once 'assets/phpScripts/connect.php';
session_start();
if (!isset($_SESSION['id'])) 
{
 header('Location:../Collab/index.php');
 exit();
}
require_once '../Collab/assets/phpScripts/compteinfo.php';
require_once '../Collab/assets/phpScripts/competenceinfo.php';
require_once '../Collab/assets/phpScripts/projetsinfo.php';
//to vieq the questions
$questionreq = "SELECT q.questionID, q.questionTitle, q.questionDescription,q.datePub, c.firstName, c.familyName,c.imageUrl, s.etat
        FROM question q
        JOIN collaborator c ON q.collaboratorID = c.collaboratorID
        JOIN state s ON q.stateID = s.stateID
        ORDER BY q.datePub DESC";
$stmt = $bdd->prepare($questionreq);
$stmt->execute();
$questions = $stmt->fetchAll();
$keywordreq = "SELECT * FROM keyword";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" async></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" async></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" async></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/js/interested1.js" async></script>
    <script src="assets/js/reaction.js" async></script>
    <script src="assets/js/participated.js" async></script>
    <link rel="stylesheet" href="assets/css/Accueil.css">
    <link rel="stylesheet" href="assets/css/formation.css">
    <link rel="stylesheet" href="assets/css/Question.css">
    <link rel="stylesheet" href="assets/css/event.css">
    <script src="../jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>
    <link href="../jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet">
    <script src="assets/js/commantaire.js" async></script>
    <script src="assets/js/img.js" async></script>
    <script src="assets/js/search.js" async></script>
    <link rel="stylesheet" href="assets/css/commentaire.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <script>
        $(document).ready(function () {
            $(".deleteSeparateNotif2").click(function () {
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
            $(".deleteNotif2").click(function () {

                $.ajax({
                    url: '../Collab/assets/phpScripts/removeNotif.php',
                    type: 'POST',
                    data: {},
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                    }
                });
            });
        });
    </script>

    <title>Acceuil</title>
</head>
<body>
<header>
    <img src="atom.png" alt="" id="img">
    <div class="icons">
        <a href="../Question/Accueil.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
        <a href="../Profil_collab/my_view.php"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
        <div class="dropdown-center" style = "z-index: 999;">
            <a class="dropdown-toggle ms-3" data-bs-toggle="dropdown" aria-expanded="false"
               data-bs-auto-close="outside">
                <i class="fa-solid fa-bell"
                   style="<?php if (isset($_SESSION['notification']) && $_SESSION['notification'] == 1) echo "color:#ffd700;"; else echo "color: #ffffff;"; ?>"></i>
            </a>
            <div class="dropdown-menu text-body-secondary" style="min-width: 400px; z-index: 999;">
                <?php
                $req_notif = "SELECT notificationID, message, created_at FROM collabnotification NATURAL JOIN notifications WHERE collaboratorID = :collaboratorID ORDER BY created_at DESC";
                $stmtNotif = $bdd->prepare($req_notif);
                $stmtNotif->bindParam(':collaboratorID', $_SESSION['id'], PDO::PARAM_INT);
                $stmtNotif->execute();
                if ($stmtNotif->rowCount() == 0) {
                    echo "<div class='dropdown-item py-3 rounded-3 text-center'> Pas de notifications </div><hr class='mt-1 mb-1'/>";
                    $_SESSION['notification'] = 0;
                } else {
                    $_SESSION['notification'] = 1;
                }

                $notifications = $stmtNotif->fetchAll(PDO::FETCH_ASSOC);

                foreach ($notifications as $notification) {
                    $formattedTime = (new DateTime($notification['created_at']))->format('Y-m-d H:i');
                    echo "<div class='dropdown-item py-3 rounded-3'> 
                            <div class='row me-1'> 
                                     <div class='col-12'><button type='button' class='float-end btn-close deleteSeparateNotif2' data-notification-id = '" . $notification['notificationID'] . "' aria-label='Close'></button><br>" . htmlspecialchars($notification['message']) . "</div> 
                                     <div class='col-12 text-end'>" . htmlspecialchars($formattedTime) . "
                                        </div> 
                            </div> 
                          </div>
                            <hr class='mt-1 mb-1'/>";
                }
                ?>
                <div class="d-grid mt-2 me-2 ms-2 rounded-3">
                    <button class="btn btn-danger deleteNotif2"
                            type="button" <?php if ($_SESSION['notification'] == 0) echo "disabled"; ?> >
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
            <img src="../Collab/assets/collab_image/<?php echo $res8['imageUrl']; ?>"
            >
    </span>
</header>
<div class="main-content" id="home">
    <div class="side1">
        <h2 class="text-center mt-3">Formations</h2>
        <div class="search1">
            <i class="fa-solid fa-magnifying-glass" style="color: #c0c7d3;"></i>
            <input type="text" id="programS" onkeyup="programSearch()" placeholder="Rechercher...">
        </div>
        <div id="programContainer" class="formations">
            <?php
            $req_formation = "
                            SELECT t.*, c.categoryTitle, GROUP_CONCAT(k.keyWord) as keywords
                            FROM trainingprogram t
                            LEFT JOIN coursecategory cc ON t.courseID = cc.courseID
                            LEFT JOIN category c ON cc.categoryID = c.categoryID
                            LEFT JOIN coursekeyword ck ON t.courseID = ck.courseID
                            LEFT JOIN keyword k ON ck.keywordID = k.keywordID
                            GROUP BY t.courseID
                            ORDER BY t.courseID DESC";
            $stmt_event = $bdd->prepare($req_formation);
            $stmt_event->execute();
            $res_formation = $stmt_event->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($res_formation as $formation): ?>
                <div class="formation" id="<?php echo $formation['courseID']; ?>">
                    <p class="Title"><?php echo $formation['programTitle']; ?></p>
                    <p><b>Description :</b><?php echo $formation['programDescription']; ?> </p>
                    <p><b>Tuteur :</b> <?php echo $formation['tutor']; ?></p>
                    <p><b>Place : </b><?php echo $formation['online']; ?></p>
                    <p><b>Date de debut :</b> <?php echo $formation['startday']; ?></p>
                    <p><b>Date de fin :</b><?php echo $formation['endday']; ?></p>
                    <p><b>Categorie :</b><?php echo $formation['categoryTitle']; ?></p>
                    <p><b>Mot clés :</b><?php echo $formation['keywords']; ?></p>
                    <input type="text" value=<?php echo $formation['courseID']; ?> name="courseID" id="A" hidden>
                    <?php
                    $req_interesser1 = "SELECT * FROM signin WHERE courseID = :courseID AND collaboratorID = :collaboratorID";
                    $stmt_interesser1 = $bdd->prepare($req_interesser1);
                    $stmt_interesser1->bindParam(":courseID", $formation['courseID'], PDO::PARAM_INT);
                    $stmt_interesser1->bindParam(":collaboratorID", $_SESSION['id'], PDO::PARAM_INT);
                    $stmt_interesser1->execute();
                    if ($stmt_interesser1->rowCount() == 1) {
                        echo "<button id='interested' class ='interesser'><i class='fa-regular fa-bell-slash'></i>Interesté(e)</button>";
                    } else if ($stmt_interesser1->rowCount() == 0) {
                        echo "<button id='interested' class ='notinteresser'><i class='fa-regular fa-bell'></i>Interesser</button>";
                    }
                    ?>
                </div>
            <?php endforeach; ?>
            <script>
                function programSearch() {
                    var input, filter, cards, cardContainer, title, i, txtValue;
                    input = document.getElementById("programS");
                    filter = input.value.toUpperCase();
                    cardContainer = document.getElementById("programContainer");
                    cards = cardContainer.getElementsByClassName("formation");
                    for (i = 0; i < cards.length; i++) {
                        title = cards[i].querySelector("p.Title").textContent.toUpperCase();
                        if (title.indexOf(filter) > -1) {
                            cards[i].style.display = "";
                        } else {
                            cards[i].style.display = "none";
                        }
                    }
                }
            </script>
        </div>
    </div>
    <div class="side2">
        <h2 class="text-center mt-3">Questions</h2>
        <div class="search">
            <i class="fa-solid fa-magnifying-glass" style="color: #c0c7d3;"></i>
            <input type="text" placeholder="Rechercher..." id="input" onkeyup="QuestionSearch()">
        </div>
        <div class="add">
            <div class="Ques">
                <div class="add_question">
                    <i class="fa-solid fa-plus" style="color: #ff0000;"></i>
                    <button id="addQuestionBtn" data-bs-toggle="modal" data-bs-target="#ajouterModal-1">Question
                    </button>
                </div>
                <div class='modal fade' id='ajouterModal-1' tabindex='-1' aria-labelledby='ajouterModalLabel-1'
                     aria-hidden='true'>
                    <div class='modal-dialog modal-xl'>
                        <div class="modal-content">
                            <form action='assets/phpScripts/addQuestion.php' method='post'>
                                <div class="modal-header mx-5">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6 class="modal-title mx-5">Veuillez ajouter votre question</h6>
                                    <label class='form-label' for='titreQuestion'>Titre:</label>
                                    <input class='form-control mb-3' type='text' name='title'>
                                    <label class='form-label' for='tags'>Mots Clés:</label><br>
                                    <?php
                                    $stmt = $bdd->prepare($keywordreq);
                                    $stmt->execute();
                                    $resKeywords = $stmt->fetchAll();
                                    foreach ($resKeywords as $keywordIndex => $keyword):
                                        $keywordValue = htmlspecialchars($keyword['keyWord']);
                                        ?>
                                        <input type="checkbox" class="btn-check mt-1"
                                               id="btn-check-1-<?php echo $keywordIndex; ?>" name="tags[]"
                                               value="<?php echo $keywordValue; ?>" autocomplete="off">
                                        <label class="btn btn-primary rounded mt-1"
                                               for="btn-check-1-<?php echo $keywordIndex; ?>"><?php echo $keywordValue; ?></label>
                                    <?php endforeach; ?>
                                    <br class='mb-5'>
                                    <div class="panel-body">
                                        <label class="form-label mt-1" for="textarea">Question : </label>
                                        <textarea class='jqte-test' placeholder="poser votre question"
                                                  name='textarea' id="textarea"></textarea>
                                        <script async>
                                            $('.jqte-test').jqte();
                                            let jqteStatus = true;
                                            $(".status").click(function () {
                                                jqteStatus = !jqteStatus;
                                                $('.jqte-test').jqte({"status": jqteStatus})
                                            });
                                        </script>
                                    </div>
                                    <input type="hidden" name="questionID">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form">
                <div class="addformation">
                    <i class="fa-solid fa-plus" style="color: #03962f;"></i>
                    <button id="addProgramBtn" data-bs-toggle="modal" data-bs-target="#ajouterModal-2">Formation
                    </button>
                </div>
                <div class='modal fade' id='ajouterModal-2' tabindex='-2' aria-labelledby='ajouterModalLabel-2'
                     aria-hidden='true'>
                    <div class='modal-dialog modal-xl'>
                        <div class="modal-content">
                            <form action="assets/phpScripts/addProgram.php" method="POST" class="needs-validation"
                                  novalidate>
                                <div class="modal-header mx-5">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="programTitle" class="form-label">Titre de Formation</label>
                                        <input type="text" class="form-control" id="programTitle" name="programTitle"
                                               required>
                                        <div class="invalid-feedback">
                                            Entrez le Titre de Formation
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="programDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="programDescription" name="programDescription"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tutor" class="form-label">Tuteur</label>
                                        <input type="text" class="form-control" id="tutor" name="tutor"></input>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="1" id="online"
                                               name="online">
                                        <label class="form-check-label" for="online">
                                            en ligne
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categorie</label>
                                        <select class="form-select" id="category" name="category" required>
                                            <?php
                                            $categoryreq = "SELECT * FROM category";
                                            $stmt = $bdd->prepare($categoryreq);
                                            $stmt->execute();
                                            $resCategories = $stmt->fetchAll();
                                            foreach ($resCategories as $category):
                                                $categoryId = htmlspecialchars($category['categoryID']);
                                                $categoryTitle = htmlspecialchars($category['categoryTitle']);
                                                echo "<option value='$categoryId'>$categoryTitle</option>";
                                            endforeach;
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                           Selectionez une categorie
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <?php
                                        echo "<label class='form-label'>Mot clé (5 aux maximum)</label>";
                                        $stmt = $bdd->prepare($keywordreq);
                                        $stmt->execute();
                                        $resKeywords = $stmt->fetchAll();
                                        foreach ($resKeywords as $keywordIndex => $keyword):
                                            $keywordId = htmlspecialchars($keyword['keywordID']);
                                            $keywordValue = htmlspecialchars($keyword['keyWord']);
                                            echo "
                                                        <input type='checkbox' class='btn-check' id='btn-check-3-$keywordIndex' name='keywords[]' value='$keywordId' autocomplete='off'>
                                                        <label class='btn btn-primary rounded' for='btn-check-3-$keywordIndex'>$keywordValue</label>
                                                    ";
                                        endforeach;
                                        ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="startday" class="form-label">Date de Debut</label>
                                        <input type="datetime-local" class="form-control" id="startday" name="startday"
                                               required>
                                        <div class="invalid-feedback">
                                            Selectionez une date de debut
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="endday" class="form-label">Date de Fin</label>
                                        <input type="datetime-local" class="form-control" id="endday" name="endday"
                                               required>
                                        <div class="invalid-feedback">
                                            Selectionez une date de fin
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="durationperday" class="form-label">Volume Horaire Quotidien
                                            </label>
                                        <input type="text" class="form-control" id="durationperday"
                                               name="durationperday" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
                                    </button>
                                </div>
                            </form>
                            <script>
                                document.getElementById('endday').addEventListener('change', function () {
                                    const startDay = new Date(document.getElementById('startday').value);
                                    const endDay = new Date(this.value);
                                    const durationPerDay = Math.floor((endDay - startDay) / (1000 * 60 * 60 * 24));
                                    document.getElementById('durationperday').value = durationPerDay > 0 ? durationPerDay : 0;
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="event">
                <div class="addevent">
                    <i class="fa-solid fa-plus" style="color: #74C0FC;"></i>
                    <button id="addEventBtn" data-bs-toggle="modal" data-bs-target="#ajouterModal-3">Evenement</button>
                </div>
                <div class='modal fade' id='ajouterModal-3' tabindex='-3' aria-labelledby='ajouterModalLabel-3'
                     aria-hidden='true'>
                    <div class='modal-dialog modal-xl'>
                        <div class="modal-content">
                            <form action="assets/phpScripts/addEvent.php" method="POST" class="needs-validation"
                                  novalidate>
                                <div class="modal-header mx-5">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="eventTitle" class="form-label">Titre d'evenement</label>
                                        <input type="text" class="form-control" id="eventTitle" name="eventTitle"
                                               required>
                                        <div class="invalid-feedback">
                                            Entrez un titre d'evenement .
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="eventDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="eventDescription" name="eventDescription"
                                                  rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="place" class="form-label">Place</label>
                                        <input type="text" class="form-control" id="place" name="place"></input>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Categorie</label>
                                        <select class="form-select" id="category" name="category" required>
                                            <?php
                                            $categoryreq = "SELECT * FROM category";
                                            $stmt = $bdd->prepare($categoryreq);
                                            $stmt->execute();
                                            $resCategories = $stmt->fetchAll();
                                            foreach ($resCategories as $category):
                                                $categoryId = htmlspecialchars($category['categoryID']);
                                                $categoryTitle = htmlspecialchars($category['categoryTitle']);
                                                echo "<option value='$categoryId'>$categoryTitle</option>";
                                            endforeach;
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Selectionez une categorie .
                                        </div>
                                    </div>
                                    <div class="mb-3">

                                        <?php
                                        echo "<label class='form-label'>Keywords (select up to 5)</label>";
                                        $stmt = $bdd->prepare($keywordreq);
                                        $stmt->execute();
                                        $resKeywords = $stmt->fetchAll();
                                        foreach ($resKeywords as $keywordIndex => $keyword):
                                            $keywordId = htmlspecialchars($keyword['keywordID']);
                                            $keywordValue = htmlspecialchars($keyword['keyWord']);
                                            echo "
                                                            <input type='checkbox' class='btn-check' id='btn-check-3-$keywordIndex' name='keywords[]' value='$keywordId' autocomplete='off'>
                                                            <label class='btn btn-primary rounded' for='btn-check-3-$keywordIndex'>$keywordValue</label>
                                                        ";
                                        endforeach;
                                        ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="startday" class="form-label">date de debut</label>
                                        <input type="datetime-local" class="form-control" id="startday" name="startday"
                                               required>
                                        <div class="invalid-feedback">
                                            Selectionnez une date de debut
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="endday" class="form-label"> date de fin</label>
                                        <input type="datetime-local" class="form-control" id="endday" name="endday"
                                               required>
                                        <div class="invalid-feedback">
                                            Selectionnez une date de fin
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="durationperday" class="form-label">Volume Horaire Quotidien
                                            </label>
                                        <input type="text" class="form-control" id="durationperday"
                                               name="durationperday" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                            <script>
                                document.getElementById('endday').addEventListener('change', function () {
                                    const startDay = new Date(document.getElementById('startday').value);
                                    const endDay = new Date(this.value);
                                    const durationPerDay = Math.floor((endDay - startDay) / (1000 * 60 * 60 * 24));
                                    document.getElementById('durationperday').value = durationPerDay > 0 ? durationPerDay : 0;
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="Questions" class="Questions">
            <?php foreach ($questions as $question): ?>
                <form action="assets/phpScripts/addAnswer.php" method="post">
                    <div class="main">
                        <div class="Question">
                            <div class="header">
                                <input type="text" name="questionID" value="<?php echo $question['questionID'];?>" hidden>
                                <span class="img">
                                    <?php
                                    echo "<img src='../Collab/assets/collab_image/$question[imageUrl]'>";
                                    ?>
                                </span>
                                <?php
                                $datePub = $question['datePub'];
                                $datePubTimestamp = strtotime($datePub);
                                $currentTimestamp = time();
                                $timePassed = $currentTimestamp - $datePubTimestamp;
                                $timePassedFormatted = gmdate("H", $timePassed);
                                ?>
                                <div class="info">
                                    <p class="Nom"><?php echo $question['familyName'] . ' ' . $question['firstName']; ?></p>
                                    <p class="time"><?php echo "-time  : " . $timePassedFormatted . ' heures ' . "-etat : " . $question['etat']; ?></p>
                                    <?php
                                    $select_key_word = "Select keyWord from  keyword join questionkeyword on keyword.keywordID=questionkeyword.keywordID where questionID=:qstid";
                                    $stmt_select_key_word = $bdd->prepare($select_key_word);
                                    $stmt_select_key_word->bindParam(":qstid", $question['questionID'], PDO::PARAM_INT);
                                    $stmt_select_key_word->execute();
                                    $res_select_key_word = $stmt_select_key_word->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <?php
                                    foreach ($res_select_key_word as $keyword) {
                                        echo "<span class='keyword'>" . $keyword['keyWord'] . "</span>";
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="content2">
                                <h3 class="title"><?php echo $question['questionTitle'] . "<br><br>"; ?></h3>
                                <p><?php echo $question['questionDescription']; ?></p>
                            </div>
                            <hr>
                            <div class="footer">
                                Commentaire
                            </div>
                        </div>

                        <div class="comment">
                            <input type="text" placeholder="commentaire..."
                                   name="comment"<?php if ($question['etat'] == 'Complète' || $question['etat'] == 'Résolue') echo "disabled"; ?>>
                            <button <?php if ($question['etat'] == 'Complète' || $question['etat'] == 'Résolue') echo "disabled"; ?> >
                                Repondre
                            </button>
                            <div class="commentaires">
                                <?php
                                $req_comment = "Select * from answer natural join collabanswer ca natural join collaborator where ca.questionID=$question[questionID]";
                                $stmt_get_comments = $bdd->prepare($req_comment);
                                $stmt_get_comments->execute();
                                $comments = $stmt_get_comments->fetchAll();
                                ?>
                                <?php foreach ($comments as $comment): ?>
                                    <div class="commentaire">
                                        <div class="info_comment">
                                            <span class="comment_img">
                                                <?php
                                                echo "<img src='../Collab/assets/collab_image/$comment[imageUrl]'>";
                                                ?>
                                            </span>
                                            <p>
                                                <?php
                                                echo $comment['firstName'] . " " . $comment['familyName'];
                                                ?>
                                            </p>
                                        </div>
                                        <p>
                                            <?php
                                            echo $comment['answerText']
                                            ?>
                                        </p>
                                        <div class="reaction">
                                            <input type="text" class="idcomment"
                                                   value="<?php echo $comment['answerID']; ?>" hidden>
                                            <p><i
                                                    <?php
                                                    $collab_id = $_SESSION['id'];
                                                    $comment_id = $comment['answerID'];
                                                    $req_nbr_like = "SELECT count(*) as nbr_like from collabreact where answerID=:answerid and Reaction=1 ";
                                                    $stmt_nbr_like = $bdd->prepare($req_nbr_like);
                                                    $stmt_nbr_like->bindParam(":answerid", $comment['answerID'], PDO::PARAM_INT);
                                                    $stmt_nbr_like->execute();
                                                    $res_nbr_like = $stmt_nbr_like->fetch(PDO::FETCH_ASSOC); ?>
                                                        class="fa-regular fa-thumbs-up"
                                                        id="like"></i><span><?php echo $res_nbr_like['nbr_like']; ?></span>
                                            </p>
                                            <p><i
                                                    <?php
                                                    $req_nbr_dislike = "SELECT count(*) as nbr_dislike from collabreact where answerID=:answerid and Reaction=0";
                                                    $stmt_nbr_dislike = $bdd->prepare($req_nbr_dislike);
                                                    $stmt_nbr_dislike->bindParam(":answerid", $comment['answerID'], PDO::PARAM_INT);
                                                    $stmt_nbr_dislike->execute();
                                                    $res_nbr_dislike = $stmt_nbr_dislike->fetch(PDO::FETCH_ASSOC);
                                                    ?>
                                                        class="fa-regular fa-thumbs-down"
                                                        data-value="0"
                                                        id="dislike"></i><span><?php echo $res_nbr_dislike['nbr_dislike']; ?></span>
                                            </p>
                                            <?php if ($comment['collaboratorID'] == $_SESSION['id']): ?>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCommentModal" data-commentid="<?php echo $comment['answerID']; ?>" data-commenttext="<?php echo htmlspecialchars($comment['answerText'], ENT_QUOTES); ?>">Edit</button>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post" action="assets/phpScripts/edit_comment.php">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="comment_id" id="comment_id">
                                                            <div class="mb-3">
                                                                <label for="comment_text" class="form-label">Comment</label>
                                                                <textarea class="form-control" id="comment_text" name="comment_text" rows="3" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <script>
                                    let editCommentModal = document.getElementById('editCommentModal');
                                    editCommentModal.addEventListener('show.bs.modal', function (event) {
                                        var button = event.relatedTarget;
                                        var commentId = button.getAttribute('data-commentid');
                                        var commentText = button.getAttribute('data-commenttext');
                                        var modalCommentId = editCommentModal.querySelector('#comment_id');
                                        var modalCommentText = editCommentModal.querySelector('#comment_text');
                                        modalCommentId.value = commentId;
                                        modalCommentText.value = commentText;
                                    });
                                </script>
                            </div>

                        </div>

                    </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="side3">
        <h2 class="text-center mt-3">Evenements</h2>
        <div class="search3">
            <i class="fa-solid fa-magnifying-glass" style="color: #c0c7d3;"></i>
            <input type="text" id="eventS" onkeyup="eventSearch()" placeholder="Rechercher...">
        </div>
        <div id="eventsContainer" class="evenements">
            <?php
                $req_event = "
                            SELECT e.*, c.categoryTitle, GROUP_CONCAT(k.keyWord) as keywords
                            FROM event e
                            LEFT JOIN eventcategory ec ON e.eventID = ec.eventID
                            LEFT JOIN category c ON ec.categoryID = c.categoryID
                            LEFT JOIN eventkeyword ek ON e.eventID = ek.eventID
                            LEFT JOIN keyword k ON ek.keywordID = k.keywordID
                            GROUP BY e.eventID
                            ORDER BY e.eventID DESC";
                $stmt_event = $bdd->prepare($req_event);
                $stmt_event->execute();
                $res_event = $stmt_event->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($res_event as $event): ?>
                <div class="evenement" id="<?php echo $event['eventID']; ?>">
                    <p class="Title"><?php echo $event['eventTitle']; ?></p>
                    <p><b>Description :</b> <?php echo $event['eventDescription']; ?></p>
                    <p><b>Place :</b> <?php echo $event['place']; ?></p>
                    <p><b>Date de debut :</b> <?php echo $event['startday']; ?></p>
                    <p><b>Date de fin :</b> <?php echo $event['endDay']; ?></p>
                    <p><b>Categorie :</b> <?php echo $event['categoryTitle']; ?></p>
                    <p><b>Mot clés :</b> <?php echo $event['keywords']; ?></p>
                    <input type="text" value=<?php echo $event['eventID']; ?> name="eventID" id="B" hidden>
                    <?php
                    $req_participerevent1 = "SELECT * FROM compose WHERE eventID = :eventID AND collaboratorID = :collaboratorID";
                    $stmt_participerevent1 = $bdd->prepare($req_participerevent1);
                    $stmt_participerevent1->bindParam(":eventID", $event['eventID'], PDO::PARAM_INT);
                    $stmt_participerevent1->bindParam(":collaboratorID", $_SESSION['id'], PDO::PARAM_INT);
                    $stmt_participerevent1->execute();
                    if ($stmt_participerevent1->rowCount() == 1) {
                        echo "<button class='participer' id = 'participer' data-event-id='" . $event['eventID'] . "'><i class='fa-regular fa-bell-slash'></i>Participé(e)</button>";
                    } else {
                        echo "<button class='notparticiper' id = 'participer' data-event-id='" . $event['eventID'] . "'><i class='fa-regular fa-bell'></i>Participer</button>";
                    }
                    ?>

                </div>
            <?php endforeach; ?>
        </div>
        <script>
            function eventSearch() {
                var input, filter, cards, cardContainer, title, i, txtValue;
                input = document.getElementById("eventS");
                filter = input.value.toUpperCase();
                cardContainer = document.getElementById("eventsContainer");
                cards = cardContainer.getElementsByClassName("evenement");
                for (i = 0; i < cards.length; i++) {
                    title = cards[i].querySelector("p.Title").textContent.toUpperCase();
                    if (title.indexOf(filter) > -1) {
                        cards[i].style.display = "";
                    } else {
                        cards[i].style.display = "none";
                    }
                }
            }
        </script>
    </div>
</div>
<script>
    function QuestionSearch() {
        let input, filter, cards, cardContainer, title, i;
        input = document.getElementById("input");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("Questions");
        cards = cardContainer.getElementsByClassName("main");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".title").textContent.toUpperCase();
            if (title.indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<!-- Edit Comment Modal -->
<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCommentForm" method="post" action="edit_comment.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="comment_id" id="comment_id">
                    <div class="mb-3">
                        <label for="comment_text" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment_text" name="comment_text" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var editCommentModal = document.getElementById('editCommentModal');
    editCommentModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var commentId = button.getAttribute('data-commentid');
        var commentText = button.getAttribute('data-commenttext');
        var modalCommentId = editCommentModal.querySelector('#comment_id');
        var modalCommentText = editCommentModal.querySelector('#comment_text');
        modalCommentId.value = commentId;
        modalCommentText.value = commentText;
    });
</script>
</body>
</html>
