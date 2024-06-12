<?php
global $bdd;
require('phpScripts/connect.php');

session_start();
require("../Admin/assets/phpScripts/compteinfo.php");

if (!isset($_SESSION['id']) ) 
{
 header('Location:../Admin/index.php');
 exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/header.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body id="page-top">
<header id="header">
        <img src="atom.png" alt="" id="img">
        <div class="icons">
            <a href="../Profil_admin/my_view.php"><i class="fa-solid fa-house" style="color: #ffffff;"></i></a>
            <a href=""><i class="fa-solid fa-chart-line" style="color: #ffffff;"></i></a>
            <a href="../Admin/assets/phpScripts/deconnexion.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #ff0000;"></i></a>
        </div>
        <span>
            <?php  if(isset($res2['imageUrl'])) : ?>
                <img src="<?php echo "../Admin/assets/admin_image/".$res2['imageUrl'];?>" alt="" style="width:100%;height:100%; border-radius:50%;margin-right:10px;">
            <?php endif ?>
        </span>
       
    </header>
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column" style="margin-top: 60px">
            <div id="content">
                <div class="container-fluid text-center">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Nombre des collaborateurs</div>
                                            <?php

                                            $collabNumber = "SELECT COUNT(*) as collabNumber FROM collaborator";
                                            $stmt = $bdd->prepare($collabNumber);
                                            $stmt->execute();
                                            $collaborators = $stmt->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "$collaborators[collabNumber]" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Nombre Totale des questions</div>
                                            <?php

                                            $questionNumber = "SELECT COUNT(*) as questionNumber FROM question";
                                            $stmt = $bdd->prepare($questionNumber);
                                            $stmt->execute();
                                            $questions = $stmt->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">  <?php echo "$questions[questionNumber]" ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-question fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">pourcentage des collaborateurs qui participe a des projets
                                            </div>
                                            <?php
                                            $stmt = $bdd->prepare(
                                            "SELECT
                                                        (participating_collaborators / total_collaborators) * 100 AS percentage
                                                    FROM (
                                                        SELECT 
                                                            (SELECT COUNT(DISTINCT collaboratorID) FROM affected) AS participating_collaborators,
                                                            (SELECT COUNT(*) FROM collaborator) AS total_collaborators
                                                    ) AS subquery;
                                                     ");
                                            $stmt->execute();
                                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $percentage = $result['percentage'];
                                            ?>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $percentage; ?>%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $percentage; ?>%" aria-valuenow="70" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                demande d'inscription</div>
                                            <?php
                                                $demands = "SELECT COUNT(*) as demands FROM demande";
                                                $stmt = $bdd->prepare($demands);
                                                $stmt->execute();
                                                $demands = $stmt->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "$demands[demands]"; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Nombre des projets,formations et evenements pour chaque categorie</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                        <canvas id="categorychart" width="95vw" height="50%"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Nombres des questions dans chaque etats</h6>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="stateChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small" id="legend"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Les mots cles</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $tags = "SELECT keyWord FROM keyword";
                                    $stmt = $bdd->prepare($tags);
                                    $stmt->execute();
                                    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    <?php
                                    $total_tags = count($tags);
                                    $buttons_per_row = 4;
                                    $total_rows = ceil($total_tags / $buttons_per_row);

                                    for ($row = 0; $row < $total_rows; $row++) {
                                        echo '<div class="btn-group" role="group" aria-label="Basic example">';
                                        echo '<div class="row">';

                                        for ($col = 0; $col < $buttons_per_row; $col++) {
                                            $index = $row * $buttons_per_row + $col;
                                            if ($index < $total_tags) {
                                                echo '<div class="col">';
                                                echo "<button type='button' class='btn btn-light m-1'>" . $tags[$index]['keyWord'] . "</button>";
                                                echo '</div>';
                                            }
                                        }

                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">les categories</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $category = "SELECT * FROM category";
                                    $stmt = $bdd->prepare($category);
                                    $stmt->execute();
                                    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <?php
                                    $total_categories = count($categories);
                                    $buttons_per_row = 4;
                                    $total_rows = ceil($total_categories / $buttons_per_row);

                                    for ($row = 0; $row < $total_rows; $row++) {
                                        echo '<div class="row">';
                                        for ($col = 0; $col < $buttons_per_row; $col++) {
                                            $index = $row * $buttons_per_row + $col;
                                            if ($index < $total_categories) {
                                                $category = $categories[$index];
                                                echo '<div class="col">';
                                                echo '<button class="btn btn-light m-1" type="button">';
                                                echo $category['categoryTitle'];
                                                echo '</button>';
                                                echo '</div>';
                                            }
                                        }
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des formations</h6>
                                </div>
                                <div class="card-body">
                                    <div id="accordion">
                                        <?php
                                        $stmt = $bdd->prepare("SELECT courseID, programTitle, programDescription FROM trainingprogram");
                                        $stmt->execute();
                                        $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($programs as $program) {
                                            echo '<div class="card">';
                                            echo '<div class="card-header" id="heading' . $program['courseID'] . '">';
                                            echo '<h5 class="mb-0">';
                                            echo '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse' . $program['courseID'] . '" aria-expanded="true" aria-controls="collapse' . $program['courseID'] . '">';
                                            echo $program['programTitle'];
                                            echo '</button>';
                                            echo '</h5>';
                                            echo '</div>';
                                            echo '<div id="collapse' . $program['courseID'] . '" class="collapse" aria-labelledby="heading' . $program['courseID'] . '" data-parent="#accordion">';
                                            echo '<div class="card-body">';
                                            echo $program['programDescription'];
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Liste des événements</h6>
                                </div>
                                <div class="card-body">
                                    <div id="accordionEvents">
                                        <?php
                                        // Your PHP code to fetch data from the event table and loop through each row
                                        $stmt = $bdd->prepare("SELECT eventID,eventTitle, eventDescription FROM event");
                                        $stmt->execute();
                                        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($events as $event) {
                                            echo '<div class="card">';
                                            echo '<div class="card-header" id="eventHeading' . $event['eventID'] . '">';
                                            echo '<h5 class="mb-0">';
                                            echo '<button class="btn btn-link" data-toggle="collapse" data-target="#eventCollapse' . $event['eventID'] . '" aria-expanded="true" aria-controls="eventCollapse' . $event['eventID'] . '">';
                                            echo $event['eventTitle'];
                                            echo '</button>';
                                            echo '</h5>';
                                            echo '</div>';
                                            echo '<div id="eventCollapse' . $event['eventID'] . '" class="collapse" aria-labelledby="eventHeading' . $event['eventID'] . '" data-parent="#accordionEvents">';
                                            echo '<div class="card-body">';
                                            echo $event['eventDescription'];
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>No Copyright &copy; ILISI2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script>
        fetch('phpScripts/categoryStates.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.categoryTitle);
                const counts = data.map(item => item.total_count);
                const ctx = document.getElementById('categorychart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Nombre totale des question,formations et evenement liee a ce categorie',
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                                borderWidth: 1,
                                data: counts,
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        fetch('phpScripts/stateStats.php')  //
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('stateChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.map(item => item.state_name),
                        datasets: [{
                            label: 'Question States',
                            backgroundColor: ['#007bff', '#28a745', '#17a2b8', '#ffc107', '#dc3545'],
                            borderColor: '#fff',
                            data: data.map(item => item.question_count)
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Ensure the chart fits the container
                        legend: {
                            display: false
                        }
                    }
                });

                // Display legend
                const legend = document.getElementById('legend');
                data.forEach((item, index) => {
                    const span = document.createElement('span');
                    span.classList.add('mr-2');
                    span.innerHTML = `<i class="fas fa-circle" style="color: ${chart.data.datasets[0].backgroundColor[index]}"></i> ${item.state_name}`;
                    legend.appendChild(span);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
</body>

</html>