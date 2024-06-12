<?php
session_start();
require_once('../Collab/assets/phpScripts/compteinfo.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/projects.css">
    <title>projects</title>
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
        <div class="dropdown-center z-index-3" >
            <a class="dropdown-toggle ms-3 z-index-3" data-bs-toggle="dropdown" aria-expanded="false"
               data-bs-auto-close="outside">
                <i class="fa-solid fa-bell"
                   style="<?php if (isset($_SESSION['notification']) && $_SESSION['notification'] == 1) echo "color:#ffd700;"; else echo "color: #ffffff;"; ?>"></i>
            </a>
            <div class="z-index-3 dropdown-menu text-body-secondary" style="min-width: 400px; z-index: 300;">
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
                    echo "<div class='z-index-3 dropdown-item py-3 rounded-3'> 
                            <div class='z-index-3 row me-1'> 
                                     <div class='col-12'><button type='button' class='float-end btn-close deleteSeparateNotif2' data-notification-id = '" . $notification['notificationID'] . "' aria-label='Close'></button><br>" . htmlspecialchars($notification['message']) . "</div> 
                                     <div class='col-12 text-end'>" . htmlspecialchars($formattedTime) . "
                                        </div> 
                            </div> 
                          </div>
                            <hr class='mt-1 mb-1'/>";
                }
                ?>
                <div class="z-index-3 d-grid mt-2 me-2 ms-2 rounded-3">
                    <button class="btn btn-danger deleteNotif2"
                            type="button" <?php if ($_SESSION['notification'] == 0) echo "disabled"; ?> >
                        <i class="ms-4 fa-solid fa-trash"></i>

                    </button>
                </div>

            </div>

        </div>
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

<div class="sidebar left">
    <h5>Projects</h5>
    <ul class="project-title-list">
        <?php
        require_once 'assets/phpScripts/connect.php';

        try {
            // Fetch project titles
            if (isset($bdd)) {
                $stmt = $bdd->prepare("SELECT projectID, projectTitle FROM project");
            }
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        if ($projects):
            foreach ($projects as $project):
                ?>
                <li onclick="document.getElementById('project-<?php echo $project['projectID']; ?>').scrollIntoView({ behavior: 'smooth' });">
                    <?php echo htmlspecialchars($project['projectTitle']); ?>
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
    <h5>Collaborators</h5>
    <ul class="collaborator-list">
        <?php
        try {
            // Fetch collaborators and their project count
            $stmt = $bdd->prepare("SELECT c.firstName, c.familyName, c.imageUrl, COUNT(a.projectID) as projectCount 
                                   FROM collaborator c
                                   JOIN affected a ON c.collaboratorID = a.collaboratorID
                                   GROUP BY c.collaboratorID");
            $stmt->execute();
            $collaborators = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        if ($collaborators):
            foreach ($collaborators as $collaborator):
                ?>
                <li class="d-flex align-items-center">
                    <img src="../Collab/assets/collab_image/<?php echo htmlspecialchars($collaborator['imageUrl']); ?>" alt="Profile Image" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                    <span><?php echo htmlspecialchars($collaborator['firstName'] . ' ' . $collaborator['familyName']); ?> - <?php echo $collaborator['projectCount']; ?> projects</span>
                </li>
            <?php
            endforeach;
        else:
            echo "<p>No collaborators found.</p>";
        endif;
        ?>
    </ul>
</div>

<div class="main-content">
    <div class="search">
        <i class="fa-solid fa-magnifying-glass" style="color: #c0c7d3;"></i>
        <label for="projectSearchInput"></label>
        <input class ='z-index-1' type="text" placeholder="Rechercher..." id="projectSearchInput" onkeyup="projectSearch()">
    </div>
    <div id="projects" class="Projects">
        <?php
        try {
            // Fetch projects with details
            $stmt = $bdd->prepare("SELECT * FROM project");
            $stmt->execute();
            $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        if ($projects):
            foreach ($projects as $project):
                // Fetch collaborators and their roles for the project
                $stmt = $bdd->prepare("SELECT c.firstName, c.familyName, c.imageUrl, r.rolename 
                                       FROM collaborator c
                                       JOIN affected a ON c.collaboratorID = a.collaboratorID
                                       JOIN role r ON a.roleID = r.roleID
                                       WHERE a.projectID = :projectID");
                $stmt->bindParam(':projectID', $project['projectID'], PDO::PARAM_INT);
                $stmt->execute();
                $collaborators = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div id="project-<?php echo $project['projectID']; ?>" class="project-container card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title"><?php echo htmlspecialchars($project['projectTitle']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($project['projectDescription']); ?></p>
                                <p class="card-text"><b>Start Date:</b> <?php echo htmlspecialchars($project['startDate']); ?></p>
                                <p class="card-text"><b>End Date:</b> <?php echo htmlspecialchars($project['endDate']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="card-text"><b>Collaborators:</b></p>
                                <ul class="list-unstyled">
                                    <?php foreach ($collaborators as $collaborator): ?>
                                        <li class="d-flex align-items-center mb-2">
                                            <img src="../Collab/assets/collab_image/<?php echo htmlspecialchars($collaborator['imageUrl']); ?>" alt="Profile Image" class="rounded-circle mr-2" style="width: 40px; height: 40px;">
                                            <span><?php echo htmlspecialchars($collaborator['firstName'] . ' ' . $collaborator['familyName'] . ' - ' . $collaborator['rolename']); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
        else:
            echo "<p>No projects found.</p>";
        endif;
        ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
<script>
    function projectSearch() {
        let input, filter, cards, cardContainer, title, i;
        input = document.getElementById("projectSearchInput");
        filter = input.value.toUpperCase();
        cardContainer = document.getElementById("projects");
        cards = cardContainer.getElementsByClassName("project-container");
        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".card-title").textContent.toUpperCase();
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
