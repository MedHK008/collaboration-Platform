<?php

require_once "connect.php";
session_start();

        $programTitle = $_POST['programTitle'];
        $programDescription = $_POST['programDescription'];
        $tutor = $_POST['tutor'];
        $online = isset($_POST['online']) ? 1 : 0;
        $startday = $_POST['startday'];
        $endday = $_POST['endday'];
        $category = $_POST['category'];
        $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : [];
        $durationperday = $_POST['durationperday'];
        $publicationDate = date('Y-m-d H:i:s');

        $sql = "INSERT INTO trainingprogram (programTitle, programDescription, tutor, online, publicationDate, startday, endday, durationperday, createdBy)
                VALUES (:programTitle, :programDescription, :tutor, :online, :publicationDate, :startday, :endday, :durationperday, :createdBy)";

        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':programTitle', $programTitle);
        $stmt->bindParam(':programDescription', $programDescription);
        $stmt->bindParam(':tutor', $tutor);
        $stmt->bindParam(':online', $online);
        $stmt->bindParam(':publicationDate', $publicationDate);
        $stmt->bindParam(':startday', $startday);
        $stmt->bindParam(':endday', $endday);
        $stmt->bindParam(':durationperday', $durationperday);
        $stmt->bindParam(':createdBy', $_SESSION['id']);

        $stmt->execute();
        $courseID = $bdd->lastInsertId();
        // Insert category relationship into coursecategory table
        $sql = "INSERT INTO coursecategory (categoryID, courseID) VALUES (:categoryID, :courseID)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':categoryID', $category);
        $stmt->bindParam(':courseID', $courseID);
        $stmt->execute();

        // Insert keywords relationships into coursekeyword table
        foreach ($keywords as $keywordID) 
        {
                $sql = "INSERT INTO coursekeyword (keywordID, courseID) VALUES (:keywordID, :courseID)";
                $stmt = $bdd->prepare($sql);
                $stmt->bindParam(':keywordID', $keywordID);
                $stmt->bindParam(':courseID', $courseID);
                $stmt->execute();
        }
    
    header("location:../../Accueil.php");
