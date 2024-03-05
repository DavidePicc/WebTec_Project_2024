document.getElementById('contactForm').addEventListener('submit', function(event) {
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var phone = document.getElementById('phone').value;

    if (!isValidName(firstName)) {
        document.getElementById('firstNameError').textContent = 'Inserisci un Nome valido, niente cifre.';
        event.preventDefault();
    } else {
        document.getElementById('firstNameError').textContent = '';
    }

    if (!isValidName(lastName)) {
        document.getElementById('lastNameError').textContent = 'Inserisci un Cognome valido, niente cifre.';
        event.preventDefault();
    } else {
        document.getElementById('lastNameError').textContent = '';
    }

    if (!isValidPhoneNumber(phone)) {
        document.getElementById('phoneError').textContent = 'Inserisci un numero di telefono di 10 cifre.';
        event.preventDefault();
    } else {
        document.getElementById('phoneError').textContent = '';
    }

    if (message.length === 0) {
        document.getElementById('messageError').textContent = 'Inserisci il messaggio.';
        event.preventDefault();
    } else {
        document.getElementById('messageError').textContent = '';
    }
});

function isValidName(name) {
    return /^[a-zA-Z ]+$/.test(name);
}

function isValidPhoneNumber(phone) {
    return /^\d{10}$/.test(phone);
}
