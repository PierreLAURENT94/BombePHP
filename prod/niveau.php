<?php 
    $mysqli = new mysqli("localhost", "bombephp", "bombephp", "bombephp");

    if(!isset($_GET["id_niveau"])){
        header("Location:index.php");
    }
    
    $res = $mysqli->query("SELECT id_niveau FROM niveau WHERE id_niveau='" . $_GET["id_niveau"] . "'");
    if($res->num_rows == 0){
        header("Location:index.php");
    }

    $res = $mysqli->query("SELECT nom, record, temps_max FROM niveau WHERE id_niveau=" . $_GET["id_niveau"]);
    $rep = $rep = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>BombePHP !!! • Test_Niv</title>
        <link rel="stylesheet" type="text/css" href="bombe.css"/>
    </head>

    <body>
        <div class="centre">
            <h1>BOMBE PHP !!!</h1>
        </div>
        <div class="centre">
            <h2><span id="NomNiveau"><?php echo $rep["nom"] ?></span>(<?php echo substr(strval($rep["record"]), 0, -1) . ":" . substr(strval($rep["record"]), -1); ?>)</h2>
        </div>
        <div class="centre">
            <span id="tempsRestant"><span id="tempsRestant_seconde"><?php echo substr(strval($rep["temps_max"]), 0, -1) ?></span>:<span id="tempsRestant_secondecentieme"><?php echo substr(strval($rep["temps_max"]), -1) ?></span>
        </div>
        <div class="centre">
            <div class="cstat">
                <span class="stat" id="Stat_rouge">Rouge</span>
                <span class="stat" id="Stat_vert">Vert</span>
                <span class="stat" id="Stat_orange">Orange</span>
                <span class="stat" id="Stat_blanc">Blanc</span>
                <span class="stat" id="Stat_noir">Noir</span>
                <span class="stat" id="Stat_bleu">Bleu</span>
            </div>
        </div>
        <div class="centre">
            <div id="led"></div>
            <table>
                <?php
                    $res = $mysqli->query("SELECT rouge1, rouge2, vert1, vert2, orange1, orange2, blanc1, blanc2, noir1, noir2, bleu1, bleu2 FROM niveau WHERE id_niveau=" . $_GET["id_niveau"]);
                    $rep = $rep = $res->fetch_assoc();
                    for($ligne=1; $ligne <= 6; $ligne++){
                        echo "<tr>";
                        for($colonne=1; $colonne <= 6; $colonne++){
                            $case = $ligne . $colonne;
                            switch($case){
                                case $rep["rouge1"]:
                                    $class_couleur = "go_rouge";
                                    break;
                                case $rep["rouge2"]:
                                    $class_couleur = "go_rouge";
                                    break;
                                case $rep["vert1"]:
                                    $class_couleur = "go_vert";
                                    break;
                                case $rep["vert2"]:
                                    $class_couleur = "go_vert";
                                    break;
                                case $rep["orange1"]:
                                    $class_couleur = "go_orange";
                                    break;
                                case $rep["orange2"]:
                                    $class_couleur = "go_orange";
                                    break;
                                case $rep["blanc1"]:
                                    $class_couleur = "go_blanc";
                                    break;
                                case $rep["blanc2"]:
                                    $class_couleur = "go_blanc";
                                    break;
                                case $rep["noir1"]:
                                    $class_couleur = "go_noir";
                                    break;
                                case $rep["noir2"]:
                                    $class_couleur = "go_noir";
                                    break;
                                case $rep["bleu1"]:
                                    $class_couleur = "go_bleu";
                                    break;
                                case $rep["bleu2"]:
                                    $class_couleur = "go_bleu";
                                    break;
                                default:
                                    $class_couleur = "";
                            }
                            echo '<td class="' . $class_couleur . '"></td>';
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
            <div id="ledinvisible"></div>
        </div>
        <div class="centre">
            <h3>Pierre LAURENT • Janvier 2021</h3>
        </div>
        <div id="compte">
            
        </div>
        <div id="audio">
            <audio id="bip">
                <source src="bip.mp3"/>
            </audio>
            <audio id="boom">
                <source src="boom.mp3"/>
            </audio>
            <audio id="win">
                <source src="win.mp3"/>
            </audio>
        </div>
        <script src="bombe.js"></script>
    </body>
</html>