var content = [
document.createTextNode('Langages basés sur ECMAScript :'),
document.createTextNode('Javascript'),
	document.createTextNode('JScript'),
document.createTextNode('ActionScript'),
document.createTextNode('EX4')
];

var div = document.createElement('div');
var p = document.createElement('p');
var ul = document.createElement('ul');

div.setAttribute('id', 'divTP2');
p.appendChild(content[0]);

for(var i = 1; i < 5; i++) {
	var li = document.createElement('li');
	li.appendChild(content[i]);
	ul.appendChild(li);
}

div.appendChild(p);
div.appendChild(ul);

document.getElementById('output').appendChild(div);
