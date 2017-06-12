function deleteLastEvent() {

}

(function() {
    var input = document.querySelector('#city');
    var cities;
    input.addEventListener('keyup', function()
    {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://phpoo.local/citiesSearcher.php?city-autocomplete=' + input.value);
        xhr.send(null);
        xhr.addEventListener('load', function()
        {
            cities = xhr.responseText.split('|');
            var oldAutocomplete = document.querySelector('#autocomplete');
            var autocomplete = oldAutocomplete.cloneNode(false);
            oldAutocomplete.parentNode.replaceChild(autocomplete, oldAutocomplete);
            for (city of cities) {
                var div = document.createElement('div');
                div.classList += 'result';
                div.innerHTML = city;
                autocomplete.appendChild(div);
            }
        });
    });
}());
