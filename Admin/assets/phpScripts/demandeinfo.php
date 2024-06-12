<?php
$req = $bdd->prepare('SELECT * FROM demande;');
$req->execute();
$demandeur = $req->fetchAll();
