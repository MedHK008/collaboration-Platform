<?php
global $bdd;
session_start();
require("assets/phpScripts/connect.php");
require('../Collab/assets/phpScripts/compteinfo.php');
if (!isset($_SESSION['id'])) 
{
 header('Location:../Collab/index.php');
 exit();
}
$req_knowldge_doc="SELECT kd.*,
        GROUP_CONCAT(k.keyWord) AS keywords
        FROM knowledgedocumentcontent AS kd
        LEFT JOIN knowledgedockeyword AS kw ON kd.knowledgeDocID = kw.knowledgeDocID
        LEFT JOIN keyword AS k ON kw.keywordID = k.keywordID
        GROUP BY kd.knowledgeDocID
        ORDER BY kd.knowledgeDocID DESC;";
$stmt_knowledge_doc=$bdd->prepare($req_knowldge_doc);
$stmt_knowledge_doc->execute();
$res_knowledge_doc=$stmt_knowledge_doc->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>base de connaissance</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" async></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" async></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js"></script>
    <link href="../jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bc.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <script src="assets/js/bc.js" async></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
</head>
<body>
<header>
    <img src="atom.png" alt="" id="img">
    <div class="icons">
        <a href="../Question/Accueil.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
        <a href="../Profil_collab/my_view.php"><i class="fa-solid fa-user" style="color: #ffffff;"></i></a>
        <div class="dropdown-center d-block" style = "z-index: 999;">
            <a class="dropdown-toggle ms-3 d-block" data-bs-toggle="dropdown" aria-expanded="false"
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
        <a href="bc.php"><i class="fa-solid fa-book" style="color: #ffffff;"></i></a>
        <a href="../projects/projects.php"><i class="fa-solid fa-diagram-project" style="color: #ffffff;"></i></a>
        <a href="../Collab/assets/phpScripts/deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #dc3545;"></i></a>
    </div>
    <span>
            <?php if(isset($res8['imageUrl'])) : ?>
                <img src="<?php echo"../Collab/assets/collab_image/".$res8['imageUrl']; ?>" alt="" >
            <?php endif ?>
    </span>
</header>
<div class="sidebar left">
    <h5>resources</h5>
    <ul class="project-title-list">
        <?php
        require_once 'assets/phpScripts/connect.php';
        try {
            if (isset($bdd)) {
                $stmt = $bdd->prepare("SELECT knowledgeDocID, title FROM knowledgedocumentcontent");
            }
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        if ($projects):
            foreach ($projects as $project):
                ?>
                <li onclick="document.getElementById('document-<?php echo $project['knowledgeDocID']; ?>').scrollIntoView({ behavior: 'smooth' });">
                    <?php echo htmlspecialchars($project['title']); ?>
                </li>
            <?php
            endforeach;
        else:
            echo "<p>No projects found.</p>";
        endif;
        ?>
    </ul>
</div>
<div class="sidebar right">
    <h5>Keywords</h5>
    <ul class="collaborator-list">
        <?php
        try {
            // Fetch collaborators and their project count
            $stmt = $bdd->prepare("SELECT keyWord, COUNT(k.keywordID) as keywordCount 
                                        FROM keyword
                                        NATURAL JOIN knowledgedockeyword k
                                        GROUP BY k.keywordID
                                        ORDER BY K.keywordID
                                ");
            $stmt->execute();
            $collaborators = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        if ($collaborators):
            foreach ($collaborators as $collaborator):
                ?>
                <li class="d-flex align-items-center">
                    <span><?php echo $collaborator['keyWord'];?> - <?php echo $collaborator['keywordCount']; ?> resources</span>
                </li>
            <?php
            endforeach;
        else:
            echo "<p>No keywords found.</p>";
        endif;
        ?>
    </ul>
</div>
<div class="container">
    <div class="addDoc">
        <button id="addDocButton" class="button-9" data-bs-toggle="modal" data-bs-target="#uploadModal">Partager une connaissance</button>
    </div>
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="uploadModalLabel">Ajouter un document OU/ET Image : </h5>
                </div>
                <div class="modal-body">
                    <form action="assets/phpScripts/upload_knowledge_document.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Titre : </label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="content">Contenue : </label>
                                <textarea class='jqte-test'  placeholder="poser votre question" name='content' id="content"></textarea>
                            <script async>
                                $('.jqte-test').jqte();
                                let jqteStatus = true;
                                $(".status").click(function () {
                                    jqteStatus = !jqteStatus;
                                    $('.jqte-test').jqte({ "status": jqteStatus })
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <label class='form-label' for='tags'>Mots Clés :</label><br>
                            <?php
                            $keywordreq = "SELECT * FROM keyword";
                            $stmt = $bdd->prepare($keywordreq);
                            $stmt->execute();
                            $resKeywords = $stmt->fetchAll();
                            foreach ($resKeywords as $keywordIndex => $keyword):
                                $keywordValue = htmlspecialchars($keyword['keyWord']);
                                ?>
                                <input type="checkbox" class="btn-check" id="btn-check-1-<?php echo $keywordIndex; ?>" name="tags[]" value="<?php echo $keywordValue; ?>" autocomplete="off">
                                <label class="btn btn-primary rounded mt-1" for="btn-check-1-<?php echo $keywordIndex; ?>"><?php echo $keywordValue; ?></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Image : </label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="pdf" class="form-label">PDF :</label>
                            <input type="file" class="form-control" id="pdf" name="pdf">
                        </div>
                        <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mt-2 w-100">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="search">
        <i class="fa-solid fa-magnifying-glass" style="color:black;"></i>
        <label for="docSearchInput"></label>
        <input id="docSearchInput" type="text" placeholder="Rechercher..." onkeyup="docSearch()">
    </div>
    <div id="docs">
        <?php foreach($res_knowledge_doc as $knowldge_doc) : ?>
            <div id="document-<?php echo $knowldge_doc['knowledgeDocID']; ?>" class="bc">
                <p class="title"><?php echo $knowldge_doc['title'] ?></p>
                <blockquote><?php echo $knowldge_doc['time'] ?></blockquote>
                <div class="keywords">
                        <span><?php echo $knowldge_doc['keywords'] ; ?></span>
                </div>
                <p class="description">
                    <?php  echo $knowldge_doc['knowledgeDocumentContent'] ;?>
                </p>
                <?php  if($knowldge_doc['url_pdf']!=NULL) :?>
                    <iframe  src="assets/knowledgedoc/doc/<?php echo $knowldge_doc['url_pdf'] ;?>"></iframe>
                <?php  endif ?>
                <?php  if($knowldge_doc['url_img']!=NULL) :?>
                    <img src="assets/knowledgedoc/img/<?php echo $knowldge_doc['url_img'] ;?>" alt="">
                <?php  endif ?>
                <button><i class="fa-solid fa-plus" style="color: #ffffff;"></i>Voir details</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    function docSearch() {
        let input, filter, cards, cardContainer, title, i;
        input = document.getElementById("docSearchInput");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("docs");
        cards = cardContainer.getElementsByClassName("bc");
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
</body>
</html>