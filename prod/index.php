<?php 
    // niveau exemple:
    // INSERT INTO `niveau` (`id_niveau`, `id_utilisateur_createur`, `nom`, `record`, `id_utilisateur_record`, `temps_max`, `rouge1`, `rouge2`, `vert1`, `vert2`, `orange1`, `orange2`, `blanc1`, `blanc2`, `noir1`, `noir2`, `bleu1`, `bleu2`) VALUES (NULL, '1', 'Test_Niv', '129', '1', '300', '23', '62', '16', '36', '42', '66', '43', '56', '11', '32', '15', '46');
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
            $mysqli->query("UPDATE utilisateur SET session='$session' WHERE id_utilisateur='$id_utilisateur'");
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
                $mysqli->query("UPDATE utilisateur SET session='$session' WHERE id_utilisateur='$id_utilisateur'");
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
        $mysqli->query("UPDATE utilisateur SET session=NULL WHERE id_utilisateur='$id_utilisateur'");
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

    if(isset($pseudo_connecte)){
        if(isset($score) && isset($id_niveau_score)){
            $res = $mysqli->query("SELECT record FROM niveau WHERE id_niveau=$id_niveau_score");
            $rep = $res->fetch_assoc();
            if($rep["record"] < $score){
                $res_id_utilisateur = $mysqli->query("SELECT id_utilisateur FROM utilisateur WHERE pseudo='$pseudo_connecte'");
                $rep_id_utilisateur = $res_id_utilisateur->fetch_assoc();
                $mysqli->query("UPDATE niveau SET record='$score', id_utilisateur_record='" . $rep_id_utilisateur["id_utilisateur"] . "' WHERE id_niveau='$id_niveau_score'");
            }
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
                <?php
                    $res = $mysqli->query("SELECT id_niveau, nom, record, id_utilisateur_record, temps_max FROM niveau");
                    while($rep = $res->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $rep["nom"]; ?></td>
                    <td><?php echo substr(strval($rep["record"]), 0, -1) . ":" . substr(strval($rep["record"]), -1); ?></td>
                    <?php
                        $res_pseudo = $mysqli->query("SELECT pseudo FROM utilisateur WHERE id_utilisateur='" . $rep["id_utilisateur_record"] ."'");
                        $rep_pseudo = $res_pseudo->fetch_assoc();
                    ?>
                    <td><?php echo $rep_pseudo["pseudo"]; ?></td>
                    <td><?php echo substr(strval($rep["temps_max"]), 0, -1) . ":" . substr(strval($rep["temps_max"]), -1); ?></td>
                    <td id="aller"><a href="niveau.php?id_niveau=<?php echo $rep["id_niveau"]; ?>">GO</a></td>
                </tr>
                <?php } ?>
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