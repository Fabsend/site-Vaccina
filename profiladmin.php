<?php
$pdo = new PDO('mysql:host=localhost;dbname=mon_carnet', "root", "root");
session_start();
$id = $_SESSION['id'];
$recu_info = $pdo->prepare("SELECT * FROM utilisateur WHERE id = $id");
$recu_info->execute();
$recu_info = $recu_info->fetch();
?>


<?php


if (!empty($_POST)) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_SESSION["id"];
    $req = $pdo->prepare("UPDATE `utilisateur` SET `nom` = '$nom', `prenom` = '$prenom', `email` = '$email', `password` = '$password' WHERE `utilisateur`.`id` = '$id' ");
    $req->execute();
    header('Location: carnetadmin.php');
}

if ($_SESSION["connected"] == true){

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="footeradmin.css">
    <link rel="stylesheet" href="profil.css">
    <title>Document</title>
</head>

<body>
    <?php
    include("headeradminprofil.php") ?>

    <section class="main">
        <h2>Modifiez le profil de votre carnet </h2><br>
        <form action="#" method="POST">

            <div>
                <label for="prenom">Nom:</label>
                <input type="nom" name="nom" value="<?php
                                                    echo ($recu_info['nom']);
                                                    ?>">
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="prenom" name="prenom" value="<?php
                                                            echo ($recu_info['prenom']);
                                                            ?>">
            </div>

            <div> <label for="prenom">Adresse E-mail:</label>
                <input type="email" name="email" value="<?php
                                                        echo ($recu_info['email']);
                                                        ?>">
            </div>
            <div> <label for="prenom">Mot de Passe</label>
                <input type="text" name="password" value="<?php
                                                            echo ($recu_info['password']);
                                                            ?>">

            </div>
            <input class="submit-button" type="submit" value="Modifier">

        </form>
    </section>
    <?php
    include("footeradmin.php")
    ?>
</body>


</html>
<?php
}
else{
    header('Location: accueil.php');
}
?>