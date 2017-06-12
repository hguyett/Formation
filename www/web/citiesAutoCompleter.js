function deleteLastEvent() {

}

(function() {
    var input = document.querySelector('#city');
    var xhr = new XMLHttpRequest();
    var onLoadFunction;
    input.addEventListener('keyup', function()
    {

        xhr.open('GET', 'http://phpoo.local/citiesSearcher.php?city-autocomplete=' + input.value);
        xhr.send(null);
        var onLoadFunction;
        xhr.addEventListener('load', function()
        {
            console.log(xhr.responseText);
        });
        console.log(onLoadFunction);
    });
}());
