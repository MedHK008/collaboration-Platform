<?php
session_start();
        unset($_SESSION['connect']);
        unset($_SESSION['id']);
        unset($_SESSION['false_pass']);
        unset($_SESSION['update_pass']);
        unset($_SESSION['false_old_pass']);
        unset($_SESSION['opp_succes_update_profil']);
        session_destroy();
        header('location:../../index.php');

?>