function searchNodeList(nodeList, element) {
    var search = nodeList.firstElementChild;
    var i = 0;
    for (node of nodeList) {
        if (node === element) {
            return i;
        }
        i++
    }
    return null;
}

function keysManager(event) {
    var UP_ARROW = 38, DOWN_ARROW = 40, ENTER = 13;
    var input = document.querySelector('#city');
    var results = document.querySelectorAll('.result');
    var focus = document.activeElement;
    var focusedResultIndex = searchNodeList(results, focus);
    console.log(focusedResultIndex);
    switch (event.keyCode) {
        case UP_ARROW:
        if (results) {
            if (focusedResultIndex === null) {
                results[results.length - 1].focus();
            } else if (focusedResultIndex === 0) {
                results[results.length - 1].focus();
            } else {
                results[focusedResultIndex - 1].focus();
            }
        }

            break;
        case DOWN_ARROW:
            if (results) {
                if (focusedResultIndex === null) {
                    results[0].focus();
                } else if (focusedResultIndex === results.length - 1) {
                    results[0].focus();
                } else {
                    results[focusedResultIndex + 1].focus();
                }
            }

            break;
        case ENTER:
        console.log('enter');
            if (results) {
                if (focusedResultIndex !== null) {
                    input.value = results[focusedResultIndex].innerHTML;
                }
            }
            break;

        default:
            input.focus();
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'http://phpoo.local/citiesSearcher.php?city-autocomplete=' + input.value);
            xhr.send(null);
            xhr.addEventListener('load', function()
            {
                cities = xhr.responseText.split('|');
                cities.sort();
                var oldAutocomplete = document.querySelector('#autocomplete');
                var autocomplete = oldAutocomplete.cloneNode(false);
                oldAutocomplete.parentNode.replaceChild(autocomplete, oldAutocomplete);
                var i = 1;
                for (city of cities) {
                    var div = document.createElement('div');
                    div.classList += 'result';
                    div.setAttribute('tabindex', i);
                    div.innerHTML = city;
                    autocomplete.appendChild(div);

                    div.addEventListener('keyup', function(event)
                    {
                        keysManager(event);
                    });

                    i++;
                    if (i > 10) {
                        break;
                    }
                }
            });

    }
}

//////////
// MAIN //
//////////


(function() {
    var input = document.querySelector('#city');
    var cities;
    input.addEventListener('keyup', function(event)
    {
        keysManager(event);
    });
}());
