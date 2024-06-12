<?php
try{
    $bdd = new PDO ("mysql:host=localhost;dbname=collabplatform","root","");
}
catch(PDOException $e)
{
    echo"Votre connexion n'est pas reussie !!".$e->$getMessage();
}

