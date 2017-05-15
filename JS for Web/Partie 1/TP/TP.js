///////////////
// Functions //
///////////////

function numberToString(number) {
    if (number >= 0 && number <= 999) {
        var hundred = number - (number % 100);
        var unit = number % 10;
        var decade = number - (hundred + unit);
        var result = '';

        // zero
        if (number == 0) {
            return 'zéro';
        }

        // hundred
        if (number >= 200) {
            if (number % 100 == 0) {
                result = unitToString(hundred/100) + ' cents';
                return result;
            } else {
                result = unitToString(hundred/100) + ' cent ';
            }
        } else if (number >= 100 && number < 200) {
            result = 'cent ';
        }

        // Managing particular numbers.
        if (decade + unit >= 11 && decade + unit < 17) {
            result += particularNumberToString(decade + unit);
            return result;
        }

        // decade
        if (decade != 0) {
            result += decadeToString(decade);
        }

        if (unit == 1) {
            result += ' et un';
        } else if (unit != 0) {
            result += '-' + unitToString(unit);
        }

        return result;
    }

    return 'ERROR';
}

function unitToString(unit) {
    switch (unit) {
        case 1:
            return 'un';
            break;
        case 2:
            return 'deux';
            break;
        case 3:
            return 'trois';
            break;
        case 4:
            return 'quatre';
            break;
        case 5:
            return 'cinq';
            break;
        case 6:
            return 'six';
            break;
        case 7:
            return 'sept';
            break;
        case 8:
            return 'huit';
            break;
        case 9:
            return 'neuf';
            break;
    }
}

function decadeToString(decade) {
    switch (decade) {
        case 10:
            return 'dix';
            break;
        case 20:
            return 'vingt';
            break;
        case 30:
            return 'trente';
            break;
        case 40:
            return 'quarante';
            break;
        case 50:
            return 'cinquante';
            break;
        case 60:
            return 'soixante';
            break;
        case 70:
            return 'septante';
            break;
        case 80:
            return 'quatre-vingt';
            break;
        case 90:
            return 'nonante';
            break;
    }
}

function particularNumberToString(number) {
    switch (number) {
        case 11:
            return 'onze';
            break;
        case 12:
            return 'douze';
            break;
        case 13:
            return 'treize';
            break;
        case 14:
            return 'quatorze';
            break;
        case 15:
            return 'quinze';
            break;
        case 16:
            return 'seize';
            break;
    }
}

//////////
// MAIN //
//////////

while (true) {
    var input = prompt('Veuillez entrer un nombre entre 0 et 999');
    if (input === null || input === '') {
        break;
    }
    console.log(numberToString(input));
}
