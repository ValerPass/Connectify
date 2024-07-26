const testoTweet = document.getElementById('testoTweet');
const characterCount = document.getElementById('characterCount');

// Questa funzione qua sotto l'ho fatta per indicare all'utente quanti caratteri rimanenti può utilizzare per scrivere il tweet.
// Ogni volta che inserisci un nuovo carattere nella textarea del tweet viene chiamata la funzione che con testoTweet.value.length si prende la lunghezza
// del tweet e sottraendo a 140 questo valore restituisce il numero di caratteri rimanenti a disposzione.
testoTweet.addEventListener('input', () => {
    const remaining = 140 - testoTweet.value.length;
    characterCount.textContent = remaining + " caratteri rimanenti";
    if (remaining == 0){
        characterCount.style.color = "red"
    }
    else{
        characterCount.style.color = "#696969";
    }
});

// La funzione qua sotto serve per non permettere le sottomissione di un tweet "vuoto", formato quindi da 0 caratteri.
// La validità del tweet per quanto riguarda il numero massimo di caratteri viene fatta direttamente in HTML col parametro maxlenght = "140" applicato alla textarea.
const tweetForm = document.getElementById('newTweetForm');
const textareaError = document.getElementById('textareaError');
tweetForm.addEventListener('submit', function(e) {
    let valid = true;
    textareaError.textContent = '';

    if (testoTweet.value.trim() === '') {
        textareaError.textContent = 'Il testo del tweet non può essere vuoto!';
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
    }
});