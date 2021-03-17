<?php 
    $mysqli = new mysqli("localhost", "bombephp", "bombephp", "bombephp");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>BombePHP !!! • Test_Niv</title>
        <link rel="stylesheet" type="text/css" href="nouveau.css"/>
    </head>

    <body>
        <div class="centre">
            <h1>BOMBE PHP !!!</h1>
        </div>
        <div class="centre">
            <form method="POST" action="index.php">

                <div class="centre">
                    <input class="nouveau" type="text" name="nom" placeholder="Nom" maxlength="10" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="temps_max" placeholder="Temps max (X10)"  min="100" max="1000" required/>
                </div>

                <div class="centre">
                    <h3>Rouge 1:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="rouge_1_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="rouge_1_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Rouge 2:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="rouge_2_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="rouge_2_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Vert 1:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="vert_1_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="vert_1_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>
                
                <div class="centre">
                    <h3>Vert 2:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="vert_2_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="vert_2_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Orange 1:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="orange_1_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="orange_1_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Orange 2:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="orange_2_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="orange_2_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Blanc 1:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="blanc_1_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="blanc_1_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Blanc 2:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="blanc_2_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="blanc_2_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Noir 1:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="noir_1_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="noir_1_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>
                
                <div class="centre">
                    <h3>Noir 2:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="noir_2_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="noir_2_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Bleu 1:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="bleu_1_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="bleu_1_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <h3>Bleu 2:</h3>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="bleu_2_ligne" placeholder="Ligne"  min="1" max="6" required/>
                </div>
                <div class="centre">
                    <input class="nouveau" type="number" name="bleu_2_colonne" placeholder="Colonne"  min="1" max="6" required/>
                </div>

                <div class="centre">
                    <input id="nouveau_niveau" class="nouveau" type="submit" name="nouveau_niveau" value="Nouveau niveau !"/>
                </div>
            </form>
        </div> 
        <div class="centre">
            <h3>Pierre LAURENT • Janvier 2021</h3>
        </div>
    </body>
</html>