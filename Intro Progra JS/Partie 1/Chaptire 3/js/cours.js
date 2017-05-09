var nombre = Number(prompt("Entrez un nombre :"));
if (nombre > 0) {
    console.log(nombre + " est positif");
} else if (nombre < 0) {
    console.log(nombre + " est négatif");
} else {
    console.log(nombre + " est nul");
}

if ((nombre >= 0) && (nombre <= 100)) {
    console.log(nombre + " est compris entre 0 et 100");
}

if ((nombre < 0) || (nombre > 100)) {
    console.log(nombre + " est en dehors de l'intervalle [0, 100]");
}

if (!(nombre > 100)) {
    console.log(nombre + " est inférieur ou égal à 100");
}

var meteo = prompt("Quel temps fait-il dehors ?");
switch (meteo) {
case "soleil":
    console.log("Sortez en t-shirt.");
    break;
case "vent":
    console.log("Sortez en pull.");
    break;
case "pluie":
    console.log("Sortez en blouson.");
    break;
case "neige":
    console.log("Restez au chaud à la maison.");
    break;
default:
    console.log("Je n'ai pas compris !");
}
