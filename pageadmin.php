<?php $pdo = new PDO('mysql:host=localhost;dbname=mon_carnet', "root", "root");
session_start();
$search = "";


if (!empty($_POST["search"])) {
    $search = $_POST["search"];

    $requestusers = $pdo->prepare("SELECT * FROM utilisateur WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%'  "); //Préparer
    $requestusers->execute(); //Executer 
    $users = $requestusers->fetchall();
}

if (!empty($_POST['voir'])) {
    $_SESSION["id"] = $_POST["idinput"];
    $_SESSION["prenom"] = $_POST["prenom"];
    $_SESSION["nom"] = $_POST["nom"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["date_de_naissance"] = $_POST["date_de_naissance"];
    header('Location: carnetadmin.php');
}

if (!empty($_POST['supprimer_x'])) {
    $idinput = $_POST["idinput"];
    $requestusers = $pdo->prepare("DELETE FROM utilisateur WHERE id = '$idinput' ");
    $requestusers->execute();
}

if (!empty($_POST['admin']) && ($_POST['role'] == "user")) {
    $idinput = $_POST["idinput"];
    $requestusers = $pdo->prepare("UPDATE utilisateur SET `role` = 'admin' WHERE id = '$idinput' ");
    $requestusers->execute();
}

if (!empty($_POST['user']) && ($_POST['role'] == "admin")) {
    $idinput = $_POST["idinput"];
    $requestusers = $pdo->prepare("UPDATE utilisateur SET `role` = 'user' WHERE id = '$idinput' ");
    $requestusers->execute();
}

if ($_SESSION["connected"] == true){

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylepageadmin.css">


    <title>Document</title>
</head>

<body>
    <?php include("headeradmin.php") ?>
    <?php if ($_SESSION["role"] == "admin") { ?>

        <div class="admin">
            <div class="recherche">
                <h1>MODE ADMIN</h1>

                <div class="searchbar">

                    <h2>Recherche utilisateur</h2>
                    <form action="" method="POST" class="searchinput">
                        <input class="barrerecherche" type="text" name="search" value="" />
                        <input class="submit" type="submit" value=" rechercher" />

                    </form>
                </div>
            </div>
            <div class="user">
                <table>
                    <tr>
                        <?php if (!empty($_POST["search"])) {
                            foreach ($users as $user) {
                        ?>
                                <td>
                                    <div class="nom_user">
                                        <p> <?php echo $user["nom"] . " "; ?></p>
                                        <p> <?php echo $user["prenom"]; ?></p>
                                    </div>
                                    <form action="" method="POST" class="option_user">

                                        <input type="submit" name="voir" class=submit value=" voir le carnet">
                                        <input type="text" hidden name="idinput" value="<?php echo $user['id'] ?>">
                                        <input type="text" hidden name="nom" value="<?php echo $user['nom'] ?>">
                                        <input type="text" hidden name="prenom" value="<?php echo $user['prenom'] ?>">
                                        <input type="text" hidden name="email" value="<?php echo $user['email'] ?>">
                                        <input type="text" hidden name="date_de_naissance" value="<?php echo $user['date_de_naissance'] ?>">
                                        <input type="text" hidden name="role" value="<?php echo $user['role'] ?>">

                                        <?php if ($user["role"] == "user") {
                                        ?> <input type="submit" class="submit" name="admin" value="passer l'utilisateur en admin">
                                        <?php  } ?>

                                        <?php if ($user["role"] == "admin") {
                                        ?> <input type="submit" class="submit" name="user" value="passer l'admin en utilisateur">
                                        <?php  } ?>

                                        <input type="image" class="delete" name="supprimer" src="SM_icons/trash.png">
                                    </form>
                                </td>


                        <?php }
                        } ?>
                    </tr>
                </table>
            </div>
        </div>


        <?php include("footeradmin.php") ?>
    <?php } ?>
</body>

</html>
<?php
}
else{
    header('Location: accueil.php');
}
?>