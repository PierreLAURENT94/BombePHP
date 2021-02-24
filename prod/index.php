<?php 
    $mysqli = new mysqli("localhost", "bombephp", "bombephp", "bombephp");

    foreach($_POST as $nom => $contenu){
        $$nom = $contenu;
    }

    if(isset($inscription)){
        $res = $mysqli->query("SELECT id_utilisateur FROM utilisateur WHERE pseudo='$pseudo'");
        if($res->num_rows == 0){
            $mdp_sel = random_int(-30000, 30000);
            $mdp_sha512 = hash("sha512", $mdp_sel . $mdp);
            $mysqli->query("INSERT INTO utilisateur (pseudo, mdp_sha512, mdp_sel) VALUES ('$pseudo', '$mdp_sha512', '$mdp_sel')");
            $res = $mysqli->query("SELECT id_utilisateur FROM utilisateur WHERE pseudo='$pseudo'");
            setcookie("pseudo", $pseudo, 2147483647);
            $session = random_int(-2000000000, 2000000000);
            setcookie("session", $session, 2147483647);
            $rep = $res->fetch_assoc();
            $id_utilisateur = $rep["id_utilisateur"];
            $mysqli->query("UPDATE utilisateur SET session='$session' WHERE utilisateur.id_utilisateur='$id_utilisateur'");
            header("Location:index.php");
        }
        else{
            echo "<script>alert('Inscription non effectuée: Pseudo déjà utilisé');</script>";
        }
    }

    else if(isset($connexion)){
        $res = $mysqli->query("SELECT id_utilisateur FROM utilisateur WHERE pseudo='$pseudo'");
        if($res->num_rows > 0){
            $res = $mysqli->query("SELECT mdp_sel FROM utilisateur WHERE pseudo='$pseudo'");
            $rep = $res->fetch_assoc();
            $mdp_sha512 = hash("sha512", $rep["mdp_sel"] . $mdp);
            $res = $mysqli->query("SELECT id_utilisateur FROM utilisateur WHERE pseudo='$pseudo' AND mdp_sha512='$mdp_sha512'");
            if($res->num_rows > 0){
                setcookie("pseudo", $pseudo, 2147483647);
                $session = random_int(-2000000000, 2000000000);
                setcookie("session", $session, 2147483647);
                $rep = $res->fetch_assoc();
                $id_utilisateur = $rep["id_utilisateur"];
                $mysqli->query("UPDATE utilisateur SET session='$session' WHERE utilisateur.id_utilisateur='$id_utilisateur'");
                header("Location:index.php");
            }
            else{
                echo "<script>alert('Connexion non effectuée: Pseudo et/ou mot de passe faux');</script>";
            }
        }
        else{
            echo "<script>alert('Connexion non effectuée: Pseudo et/ou mot de passe faux');</script>";
        }
    }

    else if(isset($_GET["deconnexion"])){
        setcookie("pseudo", "", time()-1);
        setcookie("session", "", time()-1);
        $pseudo = $_COOKIE["pseudo"];
        $res = $mysqli->query("SELECT id_utilisateur FROM utilisateur WHERE pseudo='$pseudo'");
        $rep = $res->fetch_assoc();
        $id_utilisateur = $rep["id_utilisateur"];
        $mysqli->query("UPDATE utilisateur SET session=NULL WHERE utilisateur.id_utilisateur='$id_utilisateur'");
        header("Location:index.php");
    }

    if(isset($_COOKIE["pseudo"]) && isset($_COOKIE["session"])){
        $pseudo_test = $_COOKIE["pseudo"];
        $res = $mysqli->query("SELECT session FROM utilisateur WHERE pseudo='$pseudo_test'");
        $rep = $res->fetch_assoc();
        if($rep["session"] == $_COOKIE["session"]){
            $pseudo_connecte = $pseudo_test;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>BombePHP !!!</title>
        <link rel="stylesheet" type="text/css" href="menu.css"/>
    </head>

    <body>
        <div class="centre">
            <h1>BOMBE PHP !!!</h1>
        </div>
        <div class="centre">
            <table>
                <tr>
                    <th>Nom niveau</th>
                    <th>Record</th> 
                    <th>Pseudo Record</th>
                    <th>Temps maximum</th>
                    <th>Aller</th>
                </tr>
                <tr>
                    <td>Test_Niv</td>
                    <td>12:9</td>
                    <td>Universe</td>
                    <td>30:0</td>
                    <td id="aller"><a href="https://youtu.be/vUFsHFa2iFk">GO</a></td>
                </tr>
                <tr>
                    <td>Time!</td>
                    <td>1:2</td>
                    <td>Lieutenant-AMD</td>
                    <td>10:0</td>
                    <td id="aller"><a href="https://youtu.be/vUFsHFa2iFk">GO</a></td>
                </tr>
            </table>
        </div>
        <div class="centre">
            <h3>Pierre LAURENT • Janvier 2021</h3>
        </div>
        <?php
            if(isset($pseudo_connecte)){
        ?>
        <div class="centre">
            <h3 class="compte">Connecté: <span id="pseudo">
            <?php
                echo $pseudo_connecte;
            ?>
            </span></h3>
        </div>
        <div class="centre">
            <a class="compte" href="?deconnexion" id="deconnexion">Déconnexion</a>
        </div>
        <?php
            }
            else{
        ?>
        <div class="centre">
            <h3 class="compte">Non connecté</h3>
        </div>
        <form method="POST">
            <div class="centre">
                <input class="compte" type="text" name="pseudo" placeholder="Pseudo" maxlength="10" required/>
            </div>
            <div class="centre">
                <input class="compte" type="password" name="mdp" placeholder="Mot de passe" required/>
            </div>
            <div class="centre">
                <input class="compte" type="submit" name="connexion" value="Connexion"/>
                <input class="compte" type="submit" name="inscription" value="Inscription"/>
            </div>
        </form>
        <?php
            }
        ?>
    </body>
</html>