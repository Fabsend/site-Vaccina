<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=mon_carnet', "root", "root");

$req = $pdo->prepare("SELECT role, COUNT(*) FROM utilisateur GROUP BY role");
$req->execute();
$nbrusers = $req->fetchAll();

$req2 = $pdo->prepare("SELECT nomvaccin, COUNT(*) FROM vaccin GROUP BY nomvaccin");
$req2->execute();
$nbrvaccins = $req2->fetchAll();

$req3 = $pdo->prepare("SELECT date_de_naissance, COUNT(*) FROM utilisateur GROUP BY date_de_naissance");
$req3->execute();
$age = $req3->fetchAll();

$requser = $pdo->prepare("SELECT * FROM utilisateur");
$requser->execute();
$ageuser = $requser->fetchAll();

$req4 = $pdo->prepare("SELECT * FROM utilisateur WHERE DATEDIFF(NOW(),date_de_naissance) < '6935.75'");
$req4->execute();
$age2 = $req4->fetchAll();

$req5 = $pdo->prepare("SELECT * FROM utilisateur WHERE DATEDIFF(NOW(),date_de_naissance) >= '6935.75' AND DATEDIFF(NOW(),date_de_naissance) < '14975.25'");
$req5->execute();
$age3 = $req5->fetchAll();

$req6 = $pdo->prepare("SELECT * FROM utilisateur WHERE DATEDIFF(NOW(),date_de_naissance) >= '14975.25' AND DATEDIFF(NOW(),date_de_naissance) < '22280.25'");
$req6->execute();
$age4 = $req6->fetchAll();

$req7 = $pdo->prepare("SELECT * FROM utilisateur WHERE DATEDIFF(NOW(),date_de_naissance) >= '22280.25'");
$req7->execute();
$age5 = $req7->fetchAll();

$req8 = $pdo->prepare("SELECT ROUND(AVG(DATEDIFF(NOW(), date_de_naissance)/365.25)) FROM utilisateur");
$req8->execute();
$age6 = $req8->fetchAll();

$req9 = $pdo->prepare("SELECT nom_vaccin, COUNT(*) FROM type_vaccin GROUP BY nom_vaccin");
$req9->execute();
$nbrtypevaccins = $req9->fetchAll();

if ($_SESSION["connected"] == true){

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stats.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <title>Document</title>
</head>

<body>
    <?php
    include("headeradmin.php");
    ?>
    <br><br>
    <table class="csstable">
        <tr>
            <td class="colortitre"></td>
            <td class="colortitre">Nombre d'utilisateurs</td>
            <td class="colortitre">Nombre d'utilisateurs en %</td>
        </tr>
        <tr>
            <td class="colortitre">Moins de 18 ans</td>
            <td><?php echo (count($age2)) ?></td>
            <td><?php echo (round((count($age2) * 100 / (count($ageuser))), 2)) ?></td>
        </tr>
        <tr>
            <td class="colortitre">19 à 40 ans</td>
            <td><?php echo (count($age3)) ?></td>
            <td><?php echo (round((count($age3) * 100 / (count($ageuser))), 2)) ?></td>
        </tr>
        <tr>
            <td class="colortitre">41 à 60 ans</td>
            <td><?php echo (count($age4)) ?></td>
            <td><?php echo (round((count($age4) * 100 / (count($ageuser))), 2)) ?></td>
        </tr>
        <tr>
            <td class="colortitre">61 ans et plus</td>
            <td><?php echo (count($age5)) ?></td>
            <td><?php echo (round((count($age5) * 100 / (count($ageuser))), 2)) ?></td>
        </tr>
        <tr>
            <td class="colortitre">Total</td>
            <td><?php echo (count($age2) + count($age3) + count($age4) + count($age5)) ?></td>
            <td>100</td>
        </tr>
    </table><br><br>
    <table class="csstable">
        <tr>
            <td class="colortitre"></td>
            <td class="colortitre">Vaccins renseignés</td>
            <td class="colortitre">Vaccins renseignés en %</td>
        </tr>

        <?php
        foreach ($nbrvaccins as $nbrvaccin) {
            echo ("<tr>
                <td class='colortitre'>" . $nbrvaccin['nomvaccin'] . "</td>
                <td>" . $nbrvaccin['COUNT(*)'] . "</td>
                <td>" . round($nbrvaccin['COUNT(*)'] * 100 / (array_sum(array_column($nbrvaccins, 'COUNT(*)'))), 2) . "</td>
                </tr>");
        }
        ?>

        <tr>
            <td class="colortitre">Total</td>
            <td>
                <?php
                echo (array_sum(array_column($nbrvaccins, 'COUNT(*)')));
                ?>
            </td>
            <td>100</td>
        </tr>
    </table><br><br>
    <table class="csstable">
        <tr>
            <td class="taille">Age moyen des utilisateurs</td>
            <td class="taille2"><?php echo ($age6[0][0]); ?></td>
        </tr>
        <tr>
            <td class="taille">Nombre de vaccins dans la BDD</td>
            <td class="taille2"><?php echo (count($nbrtypevaccins)); ?></td>
        </tr>
    </table><br><br>
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