<?php

$pdo = new PDO('mysql:host=localhost;dbname=mon_carnet', "root",  "root");
$requestvaccin = $pdo->prepare("SELECT * FROM `vaccin` JOIN utilisateur ON vaccin.utilisateur_id=utilisateur.id"); //Préparer
$requestvaccin->execute(); //Executer 
$vaccins = $requestvaccin->fetchAll();


$requesttypevaccin = $pdo->prepare("SELECT * FROM `type_vaccin`"); //Préparer
$requesttypevaccin->execute(); //Executer 
$vaccinstype = $requesttypevaccin->fetchAll();

session_start();
$id = $_SESSION['id'];
$reqprofil = $pdo->prepare("SELECT * FROM utilisateur WHERE `id` = '$id'"); //Préparer
$reqprofil->execute(); //Executer 
$affprofil = $reqprofil->fetchAll();

if (!empty($_POST["nom"]) && !empty($_POST["date"])) {
    $nom = $_POST["nom"];
    $date = $_POST["date"];
    $id = $_SESSION['id'];



    $insertvaccin = $pdo->prepare("INSERT INTO vaccin (nomvaccin,date,utilisateur_id) VALUES ('$nom','$date','$id')");
    $insertvaccin->execute();



    include("mail.php");


    header('Location: carnet.php');
}
if (!empty($_POST['supprimer_x']) && !empty($_POST["idinput"])) {
    $idinput = $_POST["idinput"];


    $suppvaccin = $pdo->prepare("DELETE FROM vaccin WHERE idvaccin = '$idinput' ");
    $suppvaccin->execute();
    header('Location: carnet.php');
}

if ($_SESSION["connected"] == true) {

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="header.css">
        <link rel="stylesheet" href="carnet.css">
        <link rel="stylesheet" href="footer.css">
        <title>Vaccina</title>
    </head>

    <body>
        <?php include("header.php") ?>


        <div class="carnet">
            <div class="infoperso">

                <h4 title="NOM"><?php echo $affprofil[0]["nom"] ?></h4>


                <h4 title="PRENOM"><?php echo $affprofil[0]["prenom"] ?></h4>


                <h4 class="infomail" title="E-MAIL"><?php echo $affprofil[0]["email"] ?></h4>

                <h4 title="DATE DE NAISSANCE"><?php echo date('d/m/Y', strtotime($affprofil[0]["date_de_naissance"])); ?></h4>

            </div>

            <div class="vaccin">
                <form action="" method="POST" class="ajoutvaccin">
                    <div class="select">
                        <span class="fleche"></span>
                        <select name="nom" class="typedevaccin">
                            <option value="">Type de Vaccin</option>
                            <?php foreach ($vaccinstype as $vaccintype) { ?>
                                <option value="<?php echo $vaccintype["nom_vaccin"]; ?>"><?php echo $vaccintype["nom_vaccin"]; ?></option>

                            <?php } ?>

                        </select>
                    </div>

                    <div class="datevaccin  contour">

                        <input type="date" name="date" value="date du vaccin" title="Date du vaccin">
                    </div>

                    <input type="submit" class=" submit contour ajouter" value="Ajouter">

                </form>

                <div>
                    <div class="tableau">
                        <?php

                        foreach ($vaccins as $vaccin) {
                            if ($_SESSION['id'] == $vaccin['utilisateur_id']) { ?>

                                <table>
                                    <tr>
                                        <td>
                                            <div class="infovaccin">
                                                <p> <?php echo $vaccin['nomvaccin']; ?></p>
                                                <p> <?php echo date('d/m/Y', strtotime($vaccin['date']));; ?></p>
                                            </div>
                                            <div class="option-vaccin">
                                                <div class="button">
                                                    <?php echo ("<a class='modif' href='modifier.php?nomvaccin=" . $vaccin['nomvaccin'] . "&date=" . $vaccin['date'] . "&id=" . $vaccin['idvaccin'] . "'><img  src='SM_icons/modify.png'/></a>"); ?>
                                                </div>

                                                <form action="" method="POST">
                                                    <input type="text" name="idinput" hidden value="<?php echo $vaccin['idvaccin'] ?>">
                                                    <div class="button supprimer">
                                                        <input type="image" class="delete" name="supprimer" src="SM_icons/trash.png">
                                                    </div>
                                                </form>
                                            </div>


                                        </td>
                                    </tr>
                                </table>

                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>


            </div>
        </div>

        <?php include("footer.php") ?>

    </body>

    </html>

<?php
} else {
    header('Location: accueil.php');
}
?>