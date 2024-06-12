<?php
global $bdd;
require("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imageUrl = "0.png";
    $pdfUrl = NULL;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetImagePath = '../knowledgedoc/img/' . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetImagePath)) {
            $imageUrl = $imageName;
        }
    }
    else{
        $imageUrl = "0.png";
    }

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $pdfName = time() . '_' . basename($_FILES['pdf']['name']);
        $targetPdfPath = '../knowledgedoc/doc/' . $pdfName;
        if (move_uploaded_file($_FILES['pdf']['tmp_name'], $targetPdfPath)) {
            $pdfUrl = $pdfName;
        }
    }

    $req = "INSERT INTO knowledgedocumentcontent (knowledgeDocumentContent, url_img, url_pdf, title) VALUES (:content, :imageUrl, :pdfUrl, :title)";
    $stmt = $bdd->prepare($req);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':imageUrl', $imageUrl, PDO::PARAM_STR);
    $stmt->bindParam(':pdfUrl', $pdfUrl, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->execute();
    $knowledgeDocId = $bdd->lastInsertId();
    foreach($_POST['tags'] as $tag)
    {
        //echo $tag ;
        $req_get_tag = "SELECT keywordID FROM keyword WHERE keyWord = :tag";
        $stmt_get_tag = $bdd->prepare($req_get_tag);
        $stmt_get_tag->bindParam(':tag', $tag, PDO::PARAM_STR);
        $stmt_get_tag->execute();
        $id_tag=$stmt_get_tag->fetch(PDO::FETCH_ASSOC);
        $keywordID = $id_tag['keywordID'];

        // Prepare the insert query for the knowledgeDocId table
        $req_insert_keyword_knowledgeDoc = "INSERT INTO collabplatform.knowledgedockeyword (keywordID, knowledgeDocID) VALUES (:keywordID, :knowledgeDocId)";
        $stmt_insert_keyword_question = $bdd->prepare($req_insert_keyword_knowledgeDoc);
        $stmt_insert_keyword_question->bindParam(':keywordID', $keywordID, PDO::PARAM_INT);
        $stmt_insert_keyword_question->bindParam(':knowledgeDocId', $knowledgeDocId, PDO::PARAM_INT);
        $stmt_insert_keyword_question->execute();
    }

    header("Location: ..\..\bc.php");
    exit();
}