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