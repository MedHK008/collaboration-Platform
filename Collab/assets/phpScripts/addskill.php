<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("connect.php");
session_start();

if (!isset($_POST["competence"]) || !isset($_POST["level"])) {
    die("Required data is missing.");
}

$skillName = $_POST["competence"];
$levelName = $_POST["level"];

try {
    // Fetch skillID
    $req1 = "SELECT skillID FROM skill WHERE skillName = :skillName";
    $stmt = $bdd->prepare($req1);
    $stmt->bindValue(":skillName", $skillName, PDO::PARAM_STR);
    $stmt->execute();
    $skillID = $stmt->fetchColumn();
    if ($skillID === false) {
        die("Skill not found.");
    }

    // Fetch levelID
    $req2 = "SELECT levelID FROM level WHERE levelName = :levelName";
    $stmt = $bdd->prepare($req2);
    $stmt->bindValue(":levelName", $levelName, PDO::PARAM_STR);
    $stmt->execute();
    $levelID = $stmt->fetchColumn();
    if ($levelID === false) {
        die("Level not found.");
    }

    // Ensure session ID is set
    if (!isset($_SESSION['id'])) {
        die("Session ID not set.");
    }
    $collaboratorID = $_SESSION['id'];

    // Check if the skill is already associated with the collaborator
    $req_select = "SELECT * FROM collabhasskill WHERE collaboratorID = :collaboratorID AND skillID = :skillID AND levelID = :levelID";
    $stmt_select = $bdd->prepare($req_select);
    $stmt_select->bindParam(':collaboratorID', $collaboratorID, PDO::PARAM_INT);
    $stmt_select->bindParam(':skillID', $skillID, PDO::PARAM_INT);
    $stmt_select->bindParam(':levelID', $levelID, PDO::PARAM_INT);
    $stmt_select->execute();

    if ($stmt_select->rowCount() == 0) {
        // Insert the new skill association
        $req_insert = "INSERT INTO collabhasskill (collaboratorID, skillID, levelID) VALUES (:collabID, :skillID, :levelID)";
        $stmt_insert = $bdd->prepare($req_insert);
        $stmt_insert->bindValue(":collabID", $collaboratorID, PDO::PARAM_INT);
        $stmt_insert->bindValue(":skillID", $skillID, PDO::PARAM_INT);
        $stmt_insert->bindValue(":levelID", $levelID, PDO::PARAM_INT);
        $stmt_insert->execute();
    }

    header("Location: ../../gestionprofile.php#gesteskill");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
