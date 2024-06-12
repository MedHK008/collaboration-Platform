<?php

$query = "SELECT * FROM project";
$stmt = $bdd->prepare($query);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

