var position = document.getElementById('position');

document.addEventListener('mousemove', function(e) {
    position.innerHTML = 'Position X : ' + e.clientX + 'px<br />Position Y : ' + e.clientY + 'px';
    console.log(position.innerHTML);
});
