var seconde = document.getElementById("tempsRestant_seconde").innerHTML;
var seconde100m = seconde * 10;

function tempsAct() {
    seconde100m = seconde100m - 1;
    document.getElementById("tempsRestant_seconde").innerHTML = Math.trunc(seconde100m / 10);
    document.getElementById("tempsRestant_secondecentieme").innerHTML = seconde100m.toString().substring(seconde100m.toString().length - 1);
    if(seconde100m == 0){
        animeFinTemps();
        document.getElementById("boom").play();
    }
    else{
        setTimeout(tempsAct, 100);
    }
    if(seconde100m.toString().substring(seconde100m.toString().length - 1) == 0){
        document.getElementById("bip").play();
        animeLed();
    }
}

tempsAct();

function animeFinTemps(){
    if(document.getElementById("tempsRestant").style.color == "darkred"){
        document.getElementById("tempsRestant").style.color = "rgba(0, 0, 0, 0)";
    }
    else{
        document.getElementById("tempsRestant").style.color = "darkred";
    }
    setTimeout(animeFinTemps, 500);
}

var ledTour = 0;

function animeLed(){
    if(ledTour == 0){
        document.getElementById("led").style.backgroundColor = "rgba(255, 64, 64, 0.7)";
        ledTour++;
        setTimeout(animeLed, 50);
    }
    else if(ledTour == 1){
        document.getElementById("led").style.backgroundColor = "rgba(255, 64, 64, 0.9)";
        ledTour++;
        setTimeout(animeLed, 50);
    }
    else if(ledTour == 2){
        document.getElementById("led").style.backgroundColor = "rgba(255, 64, 64, 0.7)";
        ledTour++;
        setTimeout(animeLed, 50);
    }
    else{
        document.getElementById("led").style.backgroundColor = "rgba(211, 211, 211, 0.5)";
        ledTour = 0;
    }
}

var go_couleur = "aucune";

function goClick(){
    go_couleur = this.className.substring(3);
}

for(tour=0;tour <= document.getElementsByClassName("go_rouge").length - 1; tour++){
    document.getElementsByClassName("go_rouge")[tour].addEventListener("mousedown", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_vert").length - 1; tour++){
    document.getElementsByClassName("go_vert")[tour].addEventListener("mousedown", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_orange").length - 1; tour++){
    document.getElementsByClassName("go_orange")[tour].addEventListener("mousedown", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_blanc").length - 1; tour++){
    document.getElementsByClassName("go_blanc")[tour].addEventListener("mousedown", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_noir").length - 1; tour++){
    document.getElementsByClassName("go_noir")[tour].addEventListener("mousedown", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_bleu").length - 1; tour++){
    document.getElementsByClassName("go_bleu")[tour].addEventListener("mousedown", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_bleu").length - 1; tour++){
    document.getElementsByClassName("go_bleu")[tour].addEventListener("mousedown", goClick);
}

function remettreParDefaut(){
    var thisSauvClass = this.className;
    var LengthSauvClass = document.getElementsByClassName(thisSauvClass).length;
    for(tour=0;tour <= LengthSauvClass - 1; tour++){
        document.getElementsByClassName(thisSauvClass)[0].classList.add("gris");
        document.getElementsByClassName(thisSauvClass)[0].addEventListener("mouseover", appliquerCouleur);
        document.getElementsByClassName(thisSauvClass)[0].removeEventListener("click", remettreParDefaut);
        document.getElementsByClassName(thisSauvClass)[0].classList.remove(thisSauvClass);
    }
    document.getElementById("Stat_" + thisSauvClass).classList.remove("ok");
}

for(tour=0;tour <= document.getElementsByClassName("rouge").length - 1; tour++){
    document.getElementsByClassName("rouge")[tour].addEventListener("click", remettreParDefaut);
}

for(tour=0;tour <= document.getElementsByClassName("vert").length - 1; tour++){
    document.getElementsByClassName("vert")[tour].addEventListener("click", remettreParDefaut);
}

for(tour=0;tour <= document.getElementsByClassName("orange").length - 1; tour++){
    document.getElementsByClassName("orange")[tour].addEventListener("click", remettreParDefaut);
}

for(tour=0;tour <= document.getElementsByClassName("blanc").length - 1; tour++){
    document.getElementsByClassName("blanc")[tour].addEventListener("click", remettreParDefaut);
}

for(tour=0;tour <= document.getElementsByClassName("noir").length - 1; tour++){
    document.getElementsByClassName("noir")[tour].addEventListener("click", remettreParDefaut);
}

for(tour=0;tour <= document.getElementsByClassName("bleu").length - 1; tour++){
    document.getElementsByClassName("bleu")[tour].addEventListener("click", remettreParDefaut);
}

var SourisAppuyéeValeur;

function SourisAppuyée(){
    SourisAppuyéeValeur = true;
}

function SourisRelachée(){
    SourisAppuyéeValeur = false;
    //go_couleur = "aucune"
}

document.body.addEventListener("mousedown", SourisAppuyée);
document.body.addEventListener("mouseup", SourisRelachée);

for(tour=0;tour <= document.getElementsByTagName("td").length - 1; tour++){
    if(document.getElementsByTagName("td")[tour].className == ""){
        document.getElementsByTagName("td")[tour].className = "gris";
    }
}

function appliquerCouleur(){
    if(SourisAppuyéeValeur){
        if(this.className == "gris" && go_couleur != "aucune"){
            this.classList.remove("gris");
            this.classList.add(go_couleur);
            this.removeEventListener("mouseover", appliquerCouleur);
            this.addEventListener("click", remettreParDefaut);
            verefierConx(go_couleur);
        }
    }
}

for(tour=0;tour <= document.getElementsByClassName("gris").length - 1; tour++){
    document.getElementsByClassName("gris")[tour].addEventListener("mouseover", appliquerCouleur);
}

var v_encore = true;
var colonne = 1;
var ligne = 1;
var v_colonne;
var v_ligne;
var coordonnesActuelle;
var coordonneesDepart;
var coordonneesArrive;

for(tour=0;tour <= document.getElementsByTagName("td").length - 1; tour++){
    if(colonne > 6){
        colonne = 1;
        ligne++;
    }
    document.getElementsByTagName("td")[tour].id = String(ligne) + String(colonne);
    colonne++;
}

var v_gauche;
var v_droite;
var v_bas;
var v_haut;
var coordonnesActuelleDebut;
var listeDesDejaFait;
var v_EstOK;

function verefierConx(couleur){
    coordonneesDepart = RecupererColonneLigne(document.getElementsByClassName("go_" + couleur)[0].id);
    coordonneesArrive = RecupererColonneLigne(document.getElementsByClassName("go_" + couleur)[1].id);
    coordonnesActuelle = coordonneesDepart;
    listeDesDejaFait = [];
    v_EstOK = false;
    v_encore = true;
    var secu = 0;
    console.log("---NEW---");
    while(v_encore){
        console.log(coordonnesActuelle);
        coordonnesActuelleDebut = coordonnesActuelle;
        v_gauche = document.getElementById(String(coordonnesActuelle.ligne) + String(coordonnesActuelle.colonne - 1));
        v_droite = document.getElementById(String(coordonnesActuelle.ligne) + String(coordonnesActuelle.colonne + 1));
        v_bas = document.getElementById(String(coordonnesActuelle.ligne + 1) + String(coordonnesActuelle.colonne));
        v_haut = document.getElementById(String(coordonnesActuelle.ligne - 1) + String(coordonnesActuelle.colonne));
        if(v_gauche != null){
            if(EstDejaDansListe(listeDesDejaFait, RecupererColonneLigne(v_gauche.id))){
                v_gauche = null;
            }
        }
        if(v_droite != null){
            if(EstDejaDansListe(listeDesDejaFait, RecupererColonneLigne(v_droite.id))){
                v_droite = null;
            }
        }
        if(v_bas != null){
            if(EstDejaDansListe(listeDesDejaFait, RecupererColonneLigne(v_bas.id))){
                v_bas = null;
            }
        }
        if(v_haut != null){
            console.log("@@@");
            console.log(EstDejaDansListe(listeDesDejaFait, RecupererColonneLigne(v_haut.id)));
            console.log("@@@");
            if(EstDejaDansListe(listeDesDejaFait, RecupererColonneLigne(v_haut.id))){
                v_haut = null;
            }
        }

        if(v_gauche != null){
            if(v_gauche.className == couleur || v_gauche.className == "go_" + couleur){
                coordonnesActuelle = RecupererColonneLigne(v_gauche.id);
            }
        }
        if(v_droite != null){
            if(v_droite.className == couleur || v_droite.className == "go_" + couleur){
                coordonnesActuelle = RecupererColonneLigne(v_droite.id);
            }
        }
        if(v_bas != null){
            if(v_bas.className == couleur || v_bas.className == "go_" + couleur){
                coordonnesActuelle = RecupererColonneLigne(v_bas.id);
            }
        }
        console.log("___");
        console.log(v_haut);
        console.log("___");
        if(v_haut != null){
            if(v_haut.className == couleur || v_haut.className == "go_" + couleur){
                coordonnesActuelle = RecupererColonneLigne(v_haut.id);
            }
        }
        if(coordonneesArrive.colonne == coordonnesActuelle.colonne && coordonneesArrive.ligne == coordonnesActuelle.ligne){
            v_encore = false;
            CouleurValide(couleur);
        }
        else if(coordonnesActuelleDebut == coordonnesActuelle){
            v_encore = false;
            CouleurNonValide(couleur);
        }
        else{
            listeDesDejaFait.push(coordonnesActuelle);
            console.log(listeDesDejaFait);
        }
    }
}

function EstDejaDansListe(liste, qui){
        for(const element of liste) {
            console.log("777")
            console.log(element)
            console.log(qui)
            console.log("777")
            if(element.colonne == qui.colonne && element.ligne == qui.ligne){
                return true;
            }
        }
        return false;
}

function CouleurValide(couleur){
    document.getElementById("Stat_" + couleur).classList.add("ok");
}

function CouleurNonValide(couleur){
    document.getElementById("Stat_" + couleur).classList.remove("ok");
}

function RecupererColonneLigne(colonneLigneBrut){
    colonneLigneBrut = String(colonneLigneBrut);
    return {
        colonne: Number(colonneLigneBrut.substring(1)),
        ligne: Number(colonneLigneBrut.substring(0, 1))
    };
}