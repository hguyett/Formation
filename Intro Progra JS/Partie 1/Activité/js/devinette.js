/*
Activité : jeu de devinette
*/

// NE PAS MODIFIER OU SUPPRIMER LES LIGNES CI-DESSOUS
// COMPLETEZ LE PROGRAMME UNIQUEMENT APRES LE TODO

console.log("Bienvenue dans ce jeu de devinette !");

// Cette ligne génère aléatoirement un nombre entre 1 et 100
var solution = Math.floor(Math.random() * 100) + 1;

// Décommentez temporairement cette ligne pour mieux vérifier le programme
// console.log("(La solution est " + solution + ")");

// TODO : complétez le programme

var play = true;
// Tant que le joueur veut jouer, le jeu est lancé.
while (play) {

    var essais = 0; // Compte le nombre d'essais.
    var success = false; // Indique si le joueur a trouvé la solution.
    var input; // Entrée de l'utilisateur.

    // Le joueur dispose de 6 tentatives
    for (i = 1; i <= 6; i++) {
        essais = i;
        input = prompt("Entrez un nombre entre 1 et 100 ou appuyez sur escape pour abandonner la partie.");

        if (input === null) break; // Quitte la boucle si l'utilisateur a cliqué sur annuler.

        if (isNaN(input) || input < 1 || input > 100) {
            console.log("Ce n'est pas un nombre entre 1 et 100 ! Comme je suis sympa, je ne compte pas l'essai.");
            i--;
        } else {

            if (input == solution) {
                // Si le joueur a trouvé, on quitte la boucle.
                success = true;
                break;
            } else {
                // Sinon, on lui donne un indice.
                if (input < solution) {
                    console.log(input + " est trop petit.");
                } else {
                    console.log(input + " est trop grand.");
                }
            }
        }
    }

    // Message de fin de jeu.
    if (success) {
        var message = "essai";
        if (essais != 1) message += "s";
        console.log("Félicitations ! Vous avez trouvé en " + essais + " " + message + ".");
    } else {
        console.log("Dommage. La solution était " + solution + ". Retentez votre chance !");
    }

    // Propose de rejouer.
    input = prompt("Voulez-vous rejouer ? Si c'est le cas, tapez \"y\".");
    if (input != "y" && input != "Y") {
        play = false;
    } else {
        solution = Math.floor(Math.random() * 100) + 1; // Génération d'un nouveau nombre.
    }
}
