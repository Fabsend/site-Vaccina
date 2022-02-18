<?php $pdo = new PDO('mysql:host=localhost;dbname=mon_carnet',  "root", "root");
session_start();




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="headeraccueil.css">
    <link rel="stylesheet" href="mdp.css">
    <link rel="stylesheet" href="footer.css">
    <title>Vaccina</title>
</head>

<body>
    <?php
    include("headeraccueil.php") ?>

    <div class="recherche">

        <h2>Entrez votre adresse mail</h2>
        <form action="" method="POST" class="searchinput">
            <input class="barrerecherche" type="text" name="email" value="" />
            <input class="submit" type="submit" value=" Envoyer" />

        </form>


        <?php if (!empty($_POST['email'])) {

            $email = $_POST['email'];
            $requestUtilisateur = $pdo->prepare("SELECT * FROM utilisateur WHERE email='$email'");
            $requestUtilisateur->execute();
            $users = $requestUtilisateur->fetch();

            if ($users) {

                $to = $users["email"];
                $subjet = "Notification mdp - Vaccina";
                $message = "Bonjour " . $users["prenom"] . " " . $users["nom"] . ", " . "votre mot de passe est "  . $users["password"];
                $headers = "From : vaccina.nfs@gmail.com";


                if (mail($to, $subjet, $message, $headers)) {
                    echo ("mot de passe envoyer");
                } else
                    echo 'erreur';
            } else {
                echo ("Adresse mail inconnu");
            }
        }

        ?>
    </div>


    <?php include("footer.php") ?>
</body>

</html>