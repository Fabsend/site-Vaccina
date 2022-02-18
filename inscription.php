<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="inscription.css">
    <link rel="stylesheet" href="footer.css">
    <title>Document</title>
</head>

<body>
    <?php
    include("headeraccueil.php")
    ?>
    <div class="main-div">
        <div class="insc-img">
            <img src="inscription_img.jpg" alt="iimg">
        </div>
        <div class="inscription">
            <h1>Inscription</h1>
            <form action="#" method="post">
                <div class="nomprenom">
                    <div>
                        <label for="nom">Nom</label><br>
                        <input type="text" name="nom"><br>
                    </div>
                    <div>
                        <label for="prenom">Prenom</label><br>
                        <input type="text" name="prenom"><br><br>

                    </div>
                </div>
                <div>
                    <label for="date">Date de naissance</label><br>
                    <input type="date" name="date"><br><br>
                </div>
                <div>
                    <label for="email">Email</label><br>
                    <input type="email" name="email"><br><br>
                </div>
                <div>
                    <label for="mdp">Mot de passe</label><br>
                    <input type="password" name="mdp"><br><br>
                </div>
                <div class="inscrire-btn">
                    <input type="submit" value="S'inscrire">
                </div>
                <p> Vous avez déja un compte ? <a href="accueil.php">Connectez vous</a>
                </p>
            </form>
        </div>

    </div>
    <?php
    include("footer.php")
    ?>
    <?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=mon_carnet', "root", "root");
    if (!empty($_POST)) {
        if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["date"]) || empty($_POST["email"]) || empty($_POST["mdp"])) {
            echo ("Tous les champs ne sont pas remplis!!!");
        } else {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date = $_POST['date'];
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];
            $role = "user";
            $ver = $pdo->prepare("SELECT * FROM utilisateur WHERE email='$email'");
            $ver->execute();
            $users = $ver->fetch();
            $id = $users['id'];
            if ($users) {
                echo ("L'adresse email est déjà utilisée!");
            } else {
                $req = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, date_de_naissance, email, password, role) VALUES ('$nom', '$prenom', '$date', '$email', '$mdp', '$role')");
                $req->execute();
                $_SESSION['connected'] = true;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['date_de_naissance'] = $date;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $mdp;
                header('Location: accueil.php');
            }
        }
    }
    ?>
</body>

</html>