<?php
require_once 'connect.php';

    try {
        // Fetch data from form
        $eventTitle = $_POST['eventTitle'];
        $eventDescription = $_POST['eventDescription'];
        $place = $_POST['place'];
        $category = $_POST['category'];
        $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : [];
        $startday = $_POST['startday'];
        $endday = $_POST['endday'];

        // Begin transaction
        $bdd->beginTransaction();

        // Insert event into the event table
        $sql = "INSERT INTO event (publicationDate, place, eventTitle, eventDescription,startday,endDay) VALUES (NOW(), :place, :eventTitle, :eventDescription,:startday,:endDay)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':place', $place);
        $stmt->bindParam(':eventTitle', $eventTitle);
        $stmt->bindParam(':eventDescription', $eventDescription);
        $stmt->bindParam(':startday', $startday);
        $stmt->bindParam(':endDay', $endday);
        $stmt->execute();
        $eventID = $bdd->lastInsertId();

        // Insert category relationship into eventcategory table
        $sql = "INSERT INTO eventcategory (categoryID, eventID) VALUES (:categoryID, :eventID)";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':categoryID', $category);
        $stmt->bindParam(':eventID', $eventID);
        $stmt->execute();

        // Insert keywords relationships into eventkeyword table
        foreach ($keywords as $keywordID) {
            $sql = "INSERT INTO eventkeyword (keywordID, eventID) VALUES (:keywordID, :eventID)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':keywordID', $keywordID);
            $stmt->bindParam(':eventID', $eventID);
            $stmt->execute();
        }

        // Commit transaction
        $bdd->commit();
        header("location:../../Accueil.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $bdd->rollBack();
        echo "Failed to add event: " . $e->getMessage();
    }

