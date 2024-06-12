<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <link rel="stylesheet" href="assets/css/demande.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="contenue">
    <p class="title">S'inscrire</p>
    <?php if(isset($_SESSION["demande"]) && $_SESSION["demande"]==1):$_SESSION["demande"]=0  ?>
        <div class="checked">
            <i class="fa-solid fa-check" style="color: #00ff00;"></i>
            <p>Demande envoyée</p>
        </div>
    <?php endif  ?>
    <?php  if(isset($_SESSION["demande"]) && $_SESSION["demande"]==2):$_SESSION["demande"]=0  ?>
        <div class="demande_existe">
            <i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i>
            <p>Demande deja envoyée</p>
        </div>
    <?php endif  ?>
    <?php  if(isset($_SESSION["demande"]) && $_SESSION["demande"]==3):$_SESSION["demande"]=0  ?>
        <div class="collab_existe">
            <i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i>
            <p>Ces informations sont deja utilisées</p>
        </div>
    <?php endif  ?>
    <form action="assets/phpScripts/demande.php" method="post">
        <div class="id">
            <i class="fa-solid fa-user" style="color: #ffffff;"></i>
            <input type="text" placeholder="Saisir votre Nom Complet" name="fullname">
        </div>
        <div class="password">
            <i class="fa-solid fa-at" style="color: #ffffff;"></i>
            <input type="mail" placeholder="Saisir votre mail" name="email">
        </div>
        <button type="submit">Envoyer</button>
    </form>
</div>
</body>
</html>


