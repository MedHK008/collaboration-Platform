<?php
    require('connect.php');
    session_start();
    $title = $_POST['title'];
    $description = $_POST['textarea'];
    $collaboratorID = $_SESSION['id'];
    $stateID = 1; // Default state
    $sql = "INSERT INTO question (stateID, collaboratorID, questionTitle, questionDescription,datePub) VALUES (:stateID, :collaboratorID, :title, :description,NOW())";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(":stateID",$stateID,PDO::PARAM_STR);
    $stmt->bindParam(":collaboratorID",$collaboratorID,PDO::PARAM_STR);
    $stmt->bindParam(":title",$title,PDO::PARAM_STR);
    $stmt->bindParam(":description",$description,PDO::PARAM_STR);
    $stmt->execute();
    $questionID = $bdd->lastInsertId();

    foreach($_POST['tags'] as $tag)
    {
        //echo $tag ;
        $req_get_tag = "SELECT keywordID FROM keyword WHERE keyWord = :tag";
        $stmt_get_tag = $bdd->prepare($req_get_tag);
        $stmt_get_tag->bindParam(':tag', $tag, PDO::PARAM_STR);
        $stmt_get_tag->execute();
        $id_tag=$stmt_get_tag->fetch(PDO::FETCH_ASSOC);
        $keywordID = $id_tag['keywordID'];
        
        // Prepare the insert query for the questionkeyword table
        $req_insert_keyword_question = "INSERT INTO questionkeyword (keywordID, questionID) VALUES (:keywordID, :questionID)";
        $stmt_insert_keyword_question = $bdd->prepare($req_insert_keyword_question);
        $stmt_insert_keyword_question->bindParam(':keywordID', $keywordID, PDO::PARAM_INT);
        $stmt_insert_keyword_question->bindParam(':questionID', $questionID, PDO::PARAM_INT);
        $stmt_insert_keyword_question->execute();
    }
   header("Location: ..\..\Accueil.php");
