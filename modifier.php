<?php session_start();
$pdo = new PDO('mysql:host=localhost;dbname=mon_carnet', "root", "root");
$requesttypevaccin = $pdo->prepare("SELECT * FROM `type_vaccin`"); //Préparer
$requesttypevaccin->execute(); //Executer 
$vaccinstype = $requesttypevaccin->fetchAll();

if ($_SESSION["connected"] == true){

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="modifier.css">
    <title>Document</title>
</head>

<body>
    <?php
    include("header.php") ?>
    <section class="main">

        <form action="" method="POST">
            <h2>Modifiez le vaccin sur votre carnet</h2><br>
            <label for="date">Type du Vaccin</label>

            <select name="nom">
                <option value="">Type de Vaccin</option>
                <?php foreach ($vaccinstype as $vaccintype) { ?><option value="<?php echo $vaccintype["nom_vaccin"]; ?>" <?php if ($_GET['nomvaccin'] == $vaccintype["nom_vaccin"])
                                                                                                                                echo "selected";
                                                                                                                            ?>><?php echo $vaccintype["nom_vaccin"]; ?></option>

                <?php } ?>

            </select>
            <p>&thinsp;</p>
            <label for="date">Date du Vaccin</label>
            <input type="date" name="date" value="<?php
                                                    echo ($_GET['date']);
                                                    ?>">
            &thinsp;
            <input class="submit-button" type="submit" value="Modifier">
            <input type="hidden" name="id" value="<?php echo ($_GET['id']) ?>">
        </form>

        <?php
        if (!empty($_POST)) {
            $nom = $_POST['nom'];
            $date = $_POST['date'];
            $id = $_POST['id'];
            $req = $pdo->prepare("UPDATE `vaccin` SET `nomvaccin` = '$nom', `date` = '$date' WHERE `vaccin`.`idvaccin` = '$id' ");
            $req->execute();
            header('Location: carnet.php');
        }
        ?>
    </section>
    <?php
    include("footer.php")
    ?>
</body>

</html>
<?php
}
else{
    header('Location: accueil.php');
}
?>