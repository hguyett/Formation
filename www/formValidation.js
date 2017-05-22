(function() {

    var tooltip;
    var firstname = document.getElementById('firstName');
    var lastName = document.getElementById('lastName');
    if (firstname.value.length < 2) {
        tooltip = document.querySelector('#firstName').parentNode.previousElementSibling;
        tooltip.style.display = 'block';
        console.log(tooltip);
    }
    if (lastName.value.length < 2) {
        tooltip = document.querySelector('#lastName').parentNode.previousElementSibling;
        tooltip.style.display = 'block';
        console.log(tooltip);
    }

}());
