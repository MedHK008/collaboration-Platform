<?php
require("connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questionID = isset($_POST['questionID']) ? intval($_POST['questionID']) : 0;
    $titreQuestion = isset($_POST['titreQuestion']) ? htmlspecialchars(trim($_POST['titreQuestion'])) : '';
    $descriptionQuestion = isset($_POST['descriptionQuestion']) ? htmlspecialchars(trim($_POST['descriptionQuestion'])) : '';
    $tags = isset($_POST['tags']) ? $_POST['tags'] : [];

    if ($questionID && $titreQuestion && $descriptionQuestion) {
        try {
            $bdd->beginTransaction();

            $updateQuestionQuery = "UPDATE question SET questionTitle = :titreQuestion, questionDescription = :descriptionQuestion WHERE questionID = :questionID";
            $stmtUpdateQuestion = $bdd->prepare($updateQuestionQuery);
            $stmtUpdateQuestion->bindParam(':titreQuestion', $titreQuestion, PDO::PARAM_STR);
            $stmtUpdateQuestion->bindParam(':descriptionQuestion', $descriptionQuestion, PDO::PARAM_STR);
            $stmtUpdateQuestion->bindParam(':questionID', $questionID, PDO::PARAM_INT);
            $stmtUpdateQuestion->execute();

            $deleteTagsQuery = "DELETE FROM questionkeyword WHERE questionID = :questionID";
            $stmtDeleteTags = $bdd->prepare($deleteTagsQuery);
            $stmtDeleteTags->bindParam(':questionID', $questionID, PDO::PARAM_INT);
            $stmtDeleteTags->execute();

            $insertTagQuery = "INSERT INTO questionkeyword (questionID, keywordID) VALUES (:questionID, :keywordID)";
            $stmtInsertTag = $bdd->prepare($insertTagQuery);

            foreach ($tags as $tag) {
                $getKeywordIDQuery = "SELECT keywordID FROM keyword WHERE keyWord = :keyWord";
                $stmtGetKeywordID = $bdd->prepare($getKeywordIDQuery);
                $stmtGetKeywordID->bindParam(':keyWord', $tag, PDO::PARAM_STR);
                $stmtGetKeywordID->execute();
                $keywordID = $stmtGetKeywordID->fetchColumn();

                if ($keywordID) {
                    $stmtInsertTag->bindParam(':questionID', $questionID, PDO::PARAM_INT);
                    $stmtInsertTag->bindParam(':keywordID', $keywordID, PDO::PARAM_INT);
                    $stmtInsertTag->execute();
                }
            }

            $bdd->commit();

            header("Location: ../../../Profil_collab/my_view.php");
            exit;
        } catch (Exception $e) {
            $bdd->rollBack();
            echo "erreur " . $e->getMessage();
        }
    } else {
        echo "tous les inputs sont necessaires.";
    }
} else {
    echo "Invalid .";
}
?>
