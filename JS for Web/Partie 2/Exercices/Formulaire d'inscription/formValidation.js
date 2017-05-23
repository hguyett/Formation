(function() { //IIFE START

    var form = document.querySelector('form');
    var inputs = document.querySelectorAll('input');
    console.log(inputs);

    function checker(tooltip, test) {
        if (test) {
            tooltip.style.display = 'block';
            return true;
        }
        tooltip.style.display = 'none';
        return false;
    }

    form.addEventListener('submit', function(event) {
        var error = false;
        var tooltip;

        // Sex
        tooltip = document.querySelector('#male').parentNode.previousElementSibling;
        error = checker(tooltip, !inputs[0].checked && !inputs[1].checked) || error;

        // First name
        tooltip = document.querySelector('#firstName').parentNode.previousElementSibling;
        error = checker(tooltip, inputs[2].value.length < 2) || error;

        // Last name
        tooltip = document.querySelector('#lastName').parentNode.previousElementSibling;
        error = checker(tooltip, inputs[3].value.length < 2) || error;

        // dayOfBirth
        var now = new Date();
        var age = now.getFullYear() - inputs[4].valueAsDate.getFullYear();
        tooltip = document.querySelector('#dayOfBirth').parentNode.previousElementSibling;
        error = checker(tooltip, age < 5 || age > 140) || error;

        // Pseudo
        tooltip = document.querySelector('#pseudo').parentNode.previousElementSibling;
        error = checker(tooltip, inputs[5].value.length < 4) || error;

        // Password
        tooltip = document.querySelector('#password').parentNode.previousElementSibling;
        error = checker(tooltip, inputs[6].value.length < 6) || error;

        // Password Confirmation
        tooltip = document.querySelector('#passwordConfirmation').parentNode.previousElementSibling;
        error = checker(tooltip, inputs[6].value !== inputs[7].value) || error;

        if (error) event.preventDefault();

    });

}()); //IIFE END
