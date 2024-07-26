const loginForm = document.getElementById('loginForm');
const nicknameInput = document.getElementById('user');
const passwordInput = document.getElementById('pwd');
const nicknameError = document.getElementById('nicknameError');
const passwordError = document.getElementById('passwordError');
/* Mi prendo il form tramite il suo id e gli aggiungo un eventListerner sul submit. 
Ogni volta che l'utente invia il form del login per autenticarsi viene chiamata questa funzione e verifica che
i campi di username e password non siano vuoti (dato che in questo caso significherebbe sicuramente che i dati inseriti sarebbero errati)
Se uno dei due campi è vuoto, viene messo un commento di errore nello span sottostante e viene chiamata preventDefault() sull'evento e, e quindi 
il form non viene sottomesso con l'utente che dovrà ricompilare il form per inviarlo nuovamente
La varifica che lo username e la password siano corretti viene fatta solamente lato server.*/


loginForm.addEventListener('submit', function(e) {
    if (e.submitter.value === 'login') {
        let valid = true;
        nicknameError.textContent = '';
        passwordError.textContent = '';
    
        if (nicknameInput.value.trim() === '') {
            nicknameError.textContent = 'Devi inserire uno username.';
            valid = false;
        }
    
        if (passwordInput.value.trim() === '') {
            passwordError.textContent = 'Devi inserire una password.';
            valid = false;
        }
    
        if (!valid) {
            e.preventDefault();
        }
    }
});

