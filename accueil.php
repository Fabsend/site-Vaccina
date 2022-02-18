<?php
$pdo = new PDO('mysql:host=localhost;dbname=mon_carnet',  "root", "root");
session_start();




if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];


    $requestUtilisateur = $pdo->prepare("SELECT * FROM utilisateur WHERE email = '$email' AND password ='$password'");
    $requestUtilisateur->execute();
    $users = $requestUtilisateur->fetch();



    if (!empty($users) && $users['role'] == 'user') {
        $_SESSION["nom"] = $users["nom"];
        $_SESSION["prenom"] = $users["prenom"];
        $_SESSION["date_de_naissance"] = $users["date_de_naissance"];
        $_SESSION["email"] = $users["email"];
        $_SESSION["password"] = $users["password"];
        $_SESSION["id"] = $users["id"];
        $_SESSION["connected"] = true;
        header('Location: carnet.php');
    } else 
    if (!empty($users) && $users['role'] == 'admin') {
        $_SESSION["nom"] = $users["nom"];
        $_SESSION["prenom"] = $users["prenom"];
        $_SESSION["date_de_naissance"] = $users["date_de_naissance"];
        $_SESSION["email"] = $users["email"];
        $_SESSION["password"] = $users["password"];
        $_SESSION["id"] = $users["id"];
        $_SESSION["role"] = $users["role"];
        $_SESSION["connected"] = true;
        header('Location: pageadmin.php');
    } else {
        $message_erreur = true;
    }
} else {
    $message_erreur = false;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="accueil.css">
    <title>Vaccina</title>
</head>

<body>
    <?php
    include("headeraccueil.php") ?>
    <section>

        <div class="paragraph">
            <h1>Vaccina</h1>
            <p>

                <br>Gérez votre carnet vaccinal en toute sécurité
            </p>
            <img src="gettyimages.jpg" alt="">
        </div>



        <div>

            <form action="" method="POST">
                <h1>Connexion</h1>
                <input type="mail" name="email" placeholder="Adresse Mail" class="connex"> <br>
                <input type="password" name="password" placeholder="Mot de passe" class="connex"><br>
                <input type="submit" value="Valider" class="valider"><br>
                <?php
                if ($message_erreur == true) {
                    echo "<p class='message_erreur'>Utilisateur ou Mot de passe inconnu</p>
                    <p>Vous avez oubliez votre mot de passe <a href='mdp.php'> Cliquez ici</a></p>";
                } ?>
                Vous n'avez pas un compte ? <a href="inscription.php">Créer un compte</a>

            </form>
        </div>
    </section>
    <?php
    include("footer.php")
    ?>
</body>

</html>