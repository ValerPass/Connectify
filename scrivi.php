<?php 
session_start();

$pageTitle = "Scrivi";
require_once('Components/head.php'); 
?>

<body>
    <?php 
    require_once('Components/header.php');
    require_once('Components/user_not_authenticated.php');
    include('Components/errorMessage.php');
    require('Components/noscript.php');
    ?>
    <main id = "mainNewTweet">
        <h1 class = "fontCopperplate fontSizeBigger text-center">Nuovo Tweet</h1>
        <article class = "formLayout">
            <form id = "newTweetForm" action="Helpers/new_tweet.php" method="post">
                <section class="formSection">
                    <textarea name="testo" id="testoTweet" cols="30" rows="4" maxlength = "140" placeholder = "Ehi <?php echo $_SESSION['user']['firstname']?>, cosa racconti?"></textarea>
                    <!-- Lo span sottostante con ID "textareaError" serve per essere riempito con del testo mediante JS qualora ci fossero dei problemi con il testo inserito dall'utente --> 
                    <span class="errorInputComp" id="textareaError"></span>
                    <!-- Lo span sottostante serve per fare un conteggio dei caratteri rimanenti per il tweet che l'utente sta scrivendo. L'aggiornamento avviene mediante script JS -->
                    <span class="character-count" id="characterCount">140 caratteri rimanenti</span>
                </section>
                <section class="buttonSection">
                    <button class="fontCopperplate" id = "res" type="reset">Cancella</button>
                    <button class="fontCopperplate" id = "publish" type="submit">Pubblica</button>
                </section>
            </form>
        </article>
    </main>

    
    <?php 
    require('Components/footer.php');
    ?>
    <script src="Resources/tweet_validation.js"></script>
</body>