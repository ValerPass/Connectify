<?php 
session_start();
$pageTitle = "FAQ";
require_once('Components/head.php'); 

?>

<body>
    <?php require_once('Components/header.php') ?>

    <h1 class="fontCopperplate fontSizeBigger text-center">FAQ</h1>
    <div class="row">
        <?php require_once('Components/aside.php')?>
        <main class="col-6 mainHomepage">
            <section id = "sectionFAQ">
                <h2 class="text-center">Domande Frequenti</h2>
                <article class="articleHomepageBody">
                    <h3>Come posso registrarmi su Connectify?</h3>
                    <p>Per registrarti, vai alla pagina di <a class="anchorFaq" href="registrazione.php">registrazione</a> e compila i campi richiesti. Assicurati di inserire tutte le informazioni necessarie correttamente.</p>
                </article>

                <div class="borderSeparatoreBlack"></div>

                <article class="articleHomepageBody">
                    <h3>Quali sono i requisiti per il nome utente e la password?</h3>
                    <p>Il nome utente deve essere lungo da 4 a 10 caratteri e può contenere lettere, numeri, e i caratteri "-" o "_". La password deve essere lunga da 8 a 16 caratteri e deve contenere almeno 1 lettera maiuscola, 1 lettera minuscola, 2 numeri e 2 caratteri speciali tra #!@%^&*+=.</p>
                </article>

                <div class="borderSeparatoreBlack"></div>

                <article class="articleHomepageBody">
                    <h3>Come funziona la pubblicazione di tweet?</h3>
                    <p>Per pubblicare un tweet, vai alla pagina <a class="anchorFaq" href="scrivi.php">Scrivi</a>, inserisci il testo del tuo tweet (massimo 140 caratteri) e clicca sul pulsante INVIA. Dopo aver pubblicato il tweet, verrai reindirizzato alla tua bacheca. N.B: Per poter pubblicare un tweet, dovrai prima registrarti sulla piattaforma.</p>
                </article>

                <div class="borderSeparatoreBlack"></div>

                <article class="articleHomepageBody">
                    <h3>Cosa posso fare se non vedo i miei tweet nella bacheca?</h3>
                    <p>Assicurati di aver effettuato il login correttamente. Se sei loggato e non vedi ancora i tuoi tweet, verifica l'intervallo temporale impostato nel filtro della bacheca.</p>
                </article>

                <div class="borderSeparatoreBlack"></div>

                <article class="articleHomepageBody">
                    <h3>Posso usare il sito senza autenticarmi?</h3>
                    <p>Sì, puoi cliccare su "continua senza autenticarsi" nella pagina di <a class= "anchorFaq" href="login.php">login</a> per accedere alla pagina Scopri, che mostra tutti i tweet scritti da qualsiasi utente. Tuttavia, alcune funzionalità saranno limitate.</p>
                </article>

                <div class="borderSeparatoreBlack"></div>

                <article class="articleHomepageBody">
                    <h3>Cosa devo fare se vedo il messaggio "identità non verificata"?</h3>
                    <p>Questo messaggio appare quando cerchi di accedere a pagine riservate agli utenti autenticati senza essere loggato. Per usare queste funzionalità, devi effettuare il login.</p>
                </article>

            </section>

        </main>

    </div>



    <?php require_once('Components/footer.php')?>
</body>