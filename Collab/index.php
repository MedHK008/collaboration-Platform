<?php
require("assets/phpScripts/connect.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/Login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
    <div class="img">
        <p class="title">Bienvenue</p>
        <img src="atom.png">
        <p class="copyright">Copyright &copy 2024</p>
    </div>
    <div class="workspace">
        <p class="title">Se Connecter</p>
        <i class="fa-solid fa-arrow-right-to-bracket" id="login"></i>
        <?php  session_start();
        if(isset($_SESSION['false_pass']) &&   $_SESSION['false_pass']==0): $_SESSION['false_pass']=1;?>
            <div class="error">
                <i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i>
                <p>id ou password incorecte</p>
            </div>
        <?php endif?>
        <form action="assets/phpScripts/verifier_login.php" method="post">
            <div class="id">
                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                <input type="text" placeholder="Saisir votre Id" name="id">
            </div>
            <div class="password">
                <i class="fa-solid fa-key" style="color: #ffffff;"></i>
                <input type="password" placeholder="Saisir votre password" name="motPass">
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <a href="demande.php">S'inscrire</a>

    </div>
</div>
</body>
</html>
