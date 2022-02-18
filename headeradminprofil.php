<?php
$id = $_SESSION["id"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="headeradmin.css">


    <title>Header Admin</title>
</head>

<body>
    <nav>

        <input id="nav-toggle" type="checkbox">
        <div class="logo">

            <a href="pageadmin.php"><img src="vaccina logo.png" alt="logo"></a>
        </div>

        <ul class="links">
            <li><a href="carnetadmin.php">Carnet</a></li>
            <li><a href="gestion.php">Gestion des vaccins</a></li>
            <li><a href="stats.php">Statistiques</a></li>
            <li class="deconnexion"><a href="Deconnection.php">Déconnexion</a></li>
        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>



    </nav>
</body>

</html>