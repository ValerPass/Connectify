const inputField = document.getElementById("parolaTweetFilter");
const tweetsSection = document.getElementById("tweetsSection");
const noTweetsMessage = document.querySelector(".no-tweets-message");
const tweets = document.querySelectorAll(".articleTweetScopri");

inputField.addEventListener("input", filterTweets);
// Aggiungo un eventListener per l'evento input sull'inputField con id = "parolaTweetFilter". Ogni volta che viene modificato il campo input
// in questione viene chiamata la funzione filterTweets().

function filterTweets() {
    let filterText = inputField.value.toLowerCase();
    let tweetFound = false;
    /* Faccio un ciclo su tutti i tweet; 
    Per ogni tweet mi prendo il testo del tweet;
    Se il testo del tweet contiene la parola/frase indicata nel campo di input, allora viene mostrato e viene rimossa la classe hide dalla sua classlist;
    altrimenti la classe hide viene aggiunto alla sua classlist e il tweet non viene più mostrato. */
    for (let i = 0; i < tweets.length; i++) {
        let tweet = tweets[i];
        let tweetText = tweet.querySelector('.tweetText').textContent.toLowerCase();

        if (tweetText.includes(filterText)) {
            tweet.classList.remove("hide");
            tweetFound = true;
        } 
        else {
            tweet.classList.add("hide");
        }
    }

    if (tweetFound) {
        noTweetsMessage.style.display = "none";
    } 
    else {
        noTweetsMessage.style.display = "block";
    }
}