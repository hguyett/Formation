var div = document.createElement('div');
div.setAttribute('id', 'divTP4');

var form = document.createElement('form');
form.setAttribute('enctype', 'multipart/form-data');
form.setAttribute('method', 'post');
form.setAttribute('action', 'upload.php');

var fieldset = document.createElement('fieldset');
var legend = document.createElement('legend');

var div2 = document.createElement('div');
div2.setAttribute('style', 'text-align: center');

var label = document.createElement('label');
label.setAttribute('for', 'inputUpload');
label.appendChild(document.createTextNode('Image à uploader :'));

var input = document.createElement('input');
input.setAttribute('type', 'file');
input.setAttribute('name', 'inputUpload');
input.setAttribute('id', 'inputUpload');

var br = document.createElement('br');

var submit = document.createElement('input');
submit.setAttribute('type', 'submit');
submit.setAttribute('value', 'Envoyer');

div2.appendChild(label);
div2.appendChild(input);
div2.appendChild(br);
div2.appendChild(br.cloneNode(false));
div2.appendChild(submit);

fieldset.appendChild(legend);
fieldset.appendChild(div2);
form.appendChild(fieldset);
div.appendChild(form);

var output = document.getElementById('output');
output.appendChild(div);
