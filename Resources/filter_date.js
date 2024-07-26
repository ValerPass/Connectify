document.getElementById('start_date').addEventListener('change', filterTweets);
document.getElementById('end_date').addEventListener('change', filterTweets);
/* Aggiungo i due eventListener che chiameranno la funzione filterTweets ogni volta che gli input della data vengono cambiati dall'utente */

function filterTweets() {
    let startDate = document.getElementById('start_date').value;
    let endDate = document.getElementById('end_date').value;
    let tweets = document.querySelectorAll('.articleTweet');
    let noTweetsMessage = document.querySelector('.no-tweets-message');


    // Array per i tweet visibili
    let visibleTweets = [];

    // Itero su tutti i tweet
    tweets.forEach(function(tweet) {
        var tweetDate = tweet.getAttribute('data-date').split(' ')[0];
        // Ogni tweet è caratterizzato da un attributo data-date che indica la data e l'ora in cui il tweet è stato pubblicato
        // Facendo lo split e prendendo il primo elemento dell'array, sto prendendo la data in cui il tweet è stato pubblicato
    
        var showTweet = true;
    
        if (startDate && tweetDate < startDate) {
            showTweet = false;
        }
        if (endDate && tweetDate > endDate) {
            showTweet = false;
        }
        // Faccio un controllo sulla data del tweet con le date inserite dall'utente nei campi di input, e se rientra nei parametri allora lo mostro, altrimenti
        // aggiungo la classe hide alla classlist del tweet che imporrà la sua proprietà display a none.
        if (showTweet) {
            tweet.classList.remove('hide');
            visibleTweets.push(tweet);
        } else {
            tweet.classList.add('hide');
        }
    });

    // SE non ci si sono tweet visibili nell'arco temporale selezionato, allora metto la proprietà display del messaggio di noTweets a block, altirmenti a none (e quindi non lo mostro)

    if (visibleTweets.length === 0) {
        noTweetsMessage.style.display = 'block';
    } else {
        noTweetsMessage.style.display = 'none';
    }
}