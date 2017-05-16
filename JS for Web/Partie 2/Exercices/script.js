var div = document.createElement('div');
div.setAttribute('id', 'divTP1');
div.appendChild(document.createTextNode('Le '));
var strong = document.createElement('strong');
strong.appendChild(document.createTextNode('World Wide Web Consortium'));
div.appendChild(strong);
div.appendChild(document.createTextNode(', abrégé par le sigle '));
var strong = document.createElement('strong');
strong.appendChild(document.createTextNode('W3C'));
div.appendChild(strong);
div.appendChild(document.createTextNode(', est un '));
var a = document.createElement('a');
a.href = 'http;..fr.wikipedia.org/wiki/Organisme_de_normalisation';
a.title = 'Organisme de normalisation';
a.appendChild(document.createTextNode('organisme de standardisation'));
div.appendChild(a);
var text = ' à but non-lucratif chargé de promouvoir'
text += ' la compatibilité des technologies du '
div.appendChild(document.createTextNode(text));
a = document.createElement('a');
a.href = 'http://fr.wikipedia.org/wiki/World_Wide_Web';
a.title = 'World Wide Web';
a.appendChild(document.createTextNode('World Wide Web'));
div.appendChild(a);
div.appendChild(document.createTextNode('.'));

var output = document.getElementById('output');
output.appendChild(div);
