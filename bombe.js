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
    document.getElementsByClassName("go_rouge")[tour].addEventListener("click", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_vert").length - 1; tour++){
    document.getElementsByClassName("go_vert")[tour].addEventListener("click", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_orange").length - 1; tour++){
    document.getElementsByClassName("go_orange")[tour].addEventListener("click", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_blanc").length - 1; tour++){
    document.getElementsByClassName("go_blanc")[tour].addEventListener("click", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_noir").length - 1; tour++){
    document.getElementsByClassName("go_noir")[tour].addEventListener("click", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_bleu").length - 1; tour++){
    document.getElementsByClassName("go_bleu")[tour].addEventListener("click", goClick);
}

for(tour=0;tour <= document.getElementsByClassName("go_bleu").length - 1; tour++){
    document.getElementsByClassName("go_bleu")[tour].addEventListener("click", goClick);
}

function remettreParDefaut(){
    var thisSauvClass = this.className;
    var LengthSauvClass = document.getElementsByClassName(thisSauvClass).length;
    for(tour=0;tour <= LengthSauvClass - 1; tour++){
        document.getElementsByClassName(thisSauvClass)[0].removeEventListener("click", remettreParDefaut);
        document.getElementsByClassName(thisSauvClass)[0].classList.remove(thisSauvClass);
    }
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

for(tour=0;tour <= document.getElementsByClassName("bleu").length - 1; tour++){
    document.getElementsByClassName("bleu")[tour].addEventListener("click", remettreParDefaut);
}

var SourisAppuyéeValeur

function SourisAppuyée(){
    SourisAppuyéeValeur = true;
}

function SourisRelachée(){
    SourisAppuyéeValeur = false;
}

document.body.addEventListener("mousedown", SourisAppuyée);
document.body.addEventListener("mouseup", SourisRelachée);

function appliquerCouleur(){

}

for(tour=0;tour <= document.getElementsByTagName("td").length - 1; tour++){
    if(document.getElementsByTagName("td")[tour].className == ""){
        document.getElementsByTagName("td")[tour].className = "noir";
    }
}