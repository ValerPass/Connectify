const form = document.getElementById("registrationForm");

const firstName = document.getElementById("name");
const surname = document.getElementById("surname");
const address = document.getElementById("address");
const birthdate = document.getElementById("birthdate");
const nickname = document.getElementById("nick");
const password = document.getElementById("password");

const nameError = document.getElementById("nameError");
const surnameError = document.getElementById("surnameError");
const addressError = document.getElementById("addressError");
const birthdateError = document.getElementById("birthdateError");
const nicknameError = document.getElementById("nicknameError");
const passwordError = document.getElementById("passwordError");

// Regular Expressions per verificare la validità dei dati inseriti nel form di registrazione
const namePattern = /^[A-Z][a-zA-Z ]{1,11}$/;
const surnamePattern = /^[A-Z][a-zA-Z ]{1,15}$/;
const birthdatePattern = /^\d{4}-(0?[1-9]|1[0-2])-(0?[1-9]|[12][0-9]|3[01])$/;
const addressPattern = /^(Via|Corso|Largo|Piazza|Vicolo) [a-zA-Z ]+ \d{1,4}$/;
const nicknamePattern = /^[a-zA-Z][a-zA-Z0-9-_]{3,9}$/;
const passwordLengthPattern = /^[a-zA-Z0-9#!?@%^&*+=]{8,16}$/;
const passwordUppercasePattern = /[A-Z]/;
const passwordLowercasePattern = /[a-z]/;
const passwordDigitPattern = /.*\d.*\d.*/;
const passwordSpecialPattern = /.*[#!?@%^&*+=].*[#!?@%^&*+=].*/;

function validateName() {
    if (!namePattern.test(firstName.value)) {
        nameError.textContent = "Il nome inserito deve essere formato da minimo 2 e massimo 12 caratteri e deve iniziare con una maiuscola.";
    } else {
        nameError.textContent = "";
    }
}

function validateSurname() {
    if (!surnamePattern.test(surname.value)) {
        surnameError.textContent = "Il cognome inserito deve essere formato da minimo 2 e massimo 16 caratteri e deve iniziare con una maiuscola.";
    } 
    else {
        surnameError.textContent = "";
    }
}

function validateAddress() {
    if (!addressPattern.test(address.value)) {
        addressError.textContent = "L'indirizzo deve essere nella forma “Via/Corso/Largo/Piazza/Vicolo nome numeroCivico, quest'ultimo formato da massimo 4 cifre.";
    } 
    else {
        addressError.textContent = "";
    }
}

// Funzione per verificare la bisestilità dell'anno ricevuto in input
function annoBisestile(anno) {
    return anno % 4 === 0;
}

// Funzione che serve per verificare la validità della data ricevuta in input; data valida significa che il mese deve corrispondere al giorno inserito...
// Non si può per esempio indicare come data di nascita il 31 Aprile.
function isValidDate(anno, mese, giorno) {
    let daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    if (annoBisestile(anno)) {
        daysInMonth[1] = 29;
    }

    if (giorno > daysInMonth[mese - 1]) {
        return false;
    }

    return true;
}

function validateBirthdate() {
    if (!birthdatePattern.test(birthdate.value)) {
        birthdateError.textContent = "La data deve essere nella forma “aaaa-mm-gg”.";
    } 
    else {
        birthdateError.textContent = "";
    }

    if (birthdateError.textContent == ""){
        const birthdateParts = birthdate.value.split('-');
        const anno = parseInt(birthdateParts[0]);
        const mese = parseInt(birthdateParts[1]);
        const giorno = parseInt(birthdateParts[2]);

        const oggi = new Date();
        const annoCorrente = oggi.getFullYear();
        const meseCorrente = oggi.getMonth() + 1; // Mese è zero-based, quindi aggiungo 1
        const giornoCorrente = oggi.getDate();

        if (anno > annoCorrente || anno === annoCorrente && mese > meseCorrente || anno === annoCorrente && mese === meseCorrente && giorno >= giornoCorrente){
            birthdateError.textContent = "La data di nascita deve essere antecedente alla data odierna.";
        }
    
        if (!isValidDate(anno, mese, giorno)) {
            birthdateError.textContent = "La data di nascita inserita non è valida.";
        }

    }
}

function validateNickname() {
    if (!nicknamePattern.test(nickname.value)) {
        nicknameError.textContent = "Lo username deve essere lungo da 4 a 10 caratteri, con solo lettere, numeri e - o _ come valori ammessi.";
    } else {
        nicknameError.textContent = "";
    }
}

function validatePassword() {
    if (!passwordLengthPattern.test(password.value) || !passwordUppercasePattern.test(password.value) || !passwordLowercasePattern.test(password.value) || !passwordDigitPattern.test(password.value) || !passwordSpecialPattern.test(password.value)) {
        passwordError.textContent = "La password deve essere lunga da 8 a 16 caratteri e deve contenere almeno 1 lettera maiuscola, 1 lettera minuscola, 2 numeri e 2 caratteri speciali tra i seguenti (#!?@%^&*+=).";
    } else {
        passwordError.textContent = "";
    }
}

// Per ogni campo di input aggiungo un eventListener sull'azione "input"; ogni volta che viene inserito qualcosa in un campo di input viene chiamata la rispettiva funzione di validazione che ne verifica la correttezza.
// Se un dato non rispetta i requisiti richiesti, viene mostrato un messaggio di errore sottostante al campo di input.
firstName.addEventListener("input", validateName);
surname.addEventListener("input", validateSurname);
address.addEventListener("input", validateAddress);
birthdate.addEventListener("input", validateBirthdate);
nickname.addEventListener("input", validateNickname);
password.addEventListener("input", validatePassword);

// Aggiungo anche un eventListener sul form; quando provo a sottometterlo, viene chiamata questa funzione che chiama le rispettive funzione che verifican la correttezza dei campi di input, e se sono tutti corretti
// e quindi le span con gli errori sono vuote, il form viene inviato, altrimenti viene chiamata .preventDefault() sull'evento e quindi il form non può essere sottomesso.
form.addEventListener("submit", function(event) {
    validateName();
    validateSurname();
    validateAddress();
    validateBirthdate();
    validateNickname();
    validatePassword();

    if (nameError.textContent != "" || surnameError.textContent != "" || addressError.textContent != "" || birthdateError.textContent != "" || nicknameError.textContent != "" || passwordError.textContent != "") {
        event.preventDefault();
    }
});
