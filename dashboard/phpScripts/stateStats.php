<?php

include 'connect.php';

try {
    // Fetch data
    $sql = "
        SELECT s.etat AS state_name, COUNT(q.questionID) AS question_count
        FROM state s
        LEFT JOIN question q ON s.stateID = q.stateID
        GROUP BY s.etat;
    ";
    $stmt = $bdd->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

