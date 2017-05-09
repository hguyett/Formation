/*
Activité : gestion des contacts
*/

// TODO : complétez le programme

// J'utilise le UpperCamelCase pour le nom des prototypes.
function Contact(firstName, lastName) {
    this.firstName = firstName;
    this.lastName = lastName;
    this.toString = function () {
        return this.firstName + ' ' + this.lastName;
    }
};

// Retourne le menu sous forme d'une chaine de caractères.
function getMenu() {
    var menu = 'Options disponibles :\n';
    menu += '1 - Lister les contacts\n';
    menu += '2 - Ajouter un contact\n';
    menu += '0 - Quitter';
    return menu;
}

//////////
// MAIN //
//////////

// Initialisation

var contactList = []; // Tableau contenant les contacts.
var message; // Message à afficher à l'utilisateur.

// Ajout des contacts initiaux.
contactList.push(new Contact('Carole', 'Lévisse'));
contactList.push(new Contact('Mélodie', 'Nelsonne'));

var run = true;
message = 'Bienvenue dans le gestionnaire des contacts !';

// Boucle principale

while (run) {
    var input = prompt(message + '\n\nChoisissez une option ou cliquez sur annuler pour quitter.\n\n' + getMenu());

    switch (input) {
        case '1':
            message = 'Voici la liste de vos contacts :';
            contactList.forEach(function(contact) {
                message += '\n' + contact.toString();
            });
            break;

        case '2':
            var firstName = prompt('Veuillez indiquer le prénom du nouveau contact.');
            while (firstName === '') { // Si l'utilisateur a cliqué sur le bouton ok ou a pressé la touche enter sans donner d'option.
                firstName = prompt('Le prénom ne peut pas être vide. Veuillez indiquer le prénom du nouveau contact ou cliquer sur annuler.');
            }
            if (firstName === null) { // Si l'utilisateur a cliqué sur le bouton annuler ou a pressé la touche escape.
                message = 'L\'opération a été annulée.';
                break;
            }

            var lastName = prompt('Veuillez indiquer le nom du nouveau contact.');
            while (lastName === '') { // Si l'utilisateur a cliqué sur le bouton ok ou a pressé la touche enter sans donner d'option.
                lastName = prompt('Le nom ne peut pas être vide. Veuillez indiquer le nom du nouveau contact ou cliquer sur annuler.');
            }
            if (lastName === null) { // Si l'utilisateur a cliqué sur le bouton annuler ou a pressé la touche escape.
                message = 'L\'opération a été annulée.';
                break;
            }

            contactList.push(new Contact(firstName, lastName));
            message = 'Le contact a bien été ajouté à votre liste.';
            break;

        case null:
            // Si l'utilisateur a cliqué sur le bouton annuler ou a pressé la touche escape.
            // NO BREAK

        case '0':
            alert('À bientôt !');
            run = false;
            break;

        default:
            message = 'Aucune option ne correspond à votre choix.';
    }
}
