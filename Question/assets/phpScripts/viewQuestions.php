<?php

$sql = "SELECT q.questionID, q.questionTitle, q.questionDescription,q.datePub c.firstName, c.familyName, s.etat 
        FROM question q 
        JOIN collaborator c ON q.collaboratorID = c.collaboratorID 
        JOIN state s ON q.stateID = s.stateID
        ORDER BY q.datePub";
        
$stmt = $pdo->query($sql);
$questions = $stmt->fetchAll();

// while ($row = $stmt->fetch()) {
//     echo "ID: " . $row["questionID"]. " - Title: " . $row["questionTitle"]. " - Description: " . $row["questionDescription"]. " - Asked by: " . $row["firstName"]. " " . $row["familyName"]. " - State: " . $row["etat"]. "<br>";
// }
