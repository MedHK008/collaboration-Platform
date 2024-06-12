<?php
include 'connect.php';

try {
    // Fetch data
    $sql = "
        SELECT c.categoryTitle, 
               COUNT(DISTINCT qc.questionID) AS question_count,
               COUNT(DISTINCT cc.courseID) AS course_count,
               COUNT(DISTINCT ec.eventID) AS event_count,
               (COUNT(DISTINCT qc.questionID) + 
                COUNT(DISTINCT cc.courseID) + 
                COUNT(DISTINCT ec.eventID)) AS total_count
        FROM category c
        LEFT JOIN questioncategory qc ON c.categoryID = qc.categoryID
        LEFT JOIN coursecategory cc ON c.categoryID = cc.categoryID
        LEFT JOIN eventcategory ec ON c.categoryID = ec.categoryID
        GROUP BY c.categoryTitle;
    ";
    $stmt = $bdd->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
