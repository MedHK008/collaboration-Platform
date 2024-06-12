<?php
$req="SELECT * FROM skill";
$stmt=$bdd->prepare($req);
$stmt->execute();
$skills=$stmt->fetchAll();

