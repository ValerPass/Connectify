<?php 
session_start();
$pageTitle = "Bacheca";
require_once('Components/head.php'); 
?>

<body>
    <?php require_once('Components/header.php');
    // Se l'utente che sta accedendo alla pagina bacheca.php non risulta autenticato, verrà creata una pagina apposita di errore che non gli permetterà di raggiungere la vera pagina. Infatti, ci potranno accedere dalla navbar soltanto gli utenti autenticati.
    require_once('Components/user_not_authenticated.php');
    include('Components/successMessage.php');
    require('Components/noscript.php');
    
    // Faccio una query per ottenere TUTTI i tweet dell'utente loggato in questo momento per poterli caricare nella propria bacheca.
    // Ho aggiunto ORDER BY t.data DESC affinchè quando inserisco i tweet verranno visualizzati prima quelli più recenti; più si scorre verso il basso e più i tweet risalgono a tanto tempo fa.
    $user = $_SESSION['user']['username'];
    require('Helpers/db_connection_normale.php');
    $query = "SELECT t.data, t.testo, u.nome
          FROM tweets t, utenti u 
          WHERE u.username = t.username 
          AND u.username = ?
          ORDER BY t.data DESC";

    mysqli_set_charset($conn, "utf8");
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $user);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $tweet_date, $tweet_text, $name);

    // Inizializza un array per conservare i tweet
    $tweets = array();
    while (mysqli_stmt_fetch($stmt)) {
        # tweets[] = aggiunge l'elemento in ultima posizione + 1 del mio array.
        $tweets[] = [
            'data' => $tweet_date,
            'testo' => $tweet_text,
            'nome' => $name,
            'cognome' => $cognome
        ];
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    include('Components/successMessage.php');
    ?>

    <main id = "mainBacheca">
        <!-- Inizialmente nella bacheca ci sarà una sezione con i dettagli personali dell'utente, dove verranno indicati il suo nome, cognome, ecc.-->
        <h1 class = "fontCopperplate fontSizeBigger text-center">I tuoi dettagli</h1>
        <article id = "articleDettagliPersonali">
            <section class = "infoPersonaleSect">
                <p class="infoX">Nome:</p>
                <p class="infoY"> <?php echo $_SESSION['user']['firstname']?></p>
            </section>
            <div class="borderSeparatore"></div>
            <section class = "infoPersonaleSect">
                <p class="infoX">Cognome:</p>
                <p class="infoY"> <?php echo $_SESSION['user']['surname']?></p>
            </section>
            <div class="borderSeparatore"></div>
            <section class = "infoPersonaleSect">
                <p class="infoX">Data di nascita:</p>
                <p class="infoY"> <?php echo $_SESSION['user']['birthdate']?></p>
            </section>
            <div class="borderSeparatore"></div>
            <section class = "infoPersonaleSect">
                <p class="infoX">Indirizzo:</p>
                <p class="infoY"> <?php echo $_SESSION['user']['address']?></p>
            </section>
            <div class="borderSeparatore"></div>
            <section class = "infoPersonaleSect">
                <p class="infoX">Username:</p>
                <p class="infoY"> @<?php echo $_SESSION['user']['username']?></p>
            </section>

        </article>

        <div class="borderSeparatoreBigger"></div>

        <h1 class = "fontCopperplate fontSizeBigger text-center">I tuoi tweet</h1>
        <!-- Nella sezione dei tweet faccio prima il controllo sul numero di tweet che l'utente ha caricato,
        se è > 0, allora creo il filtro per data e li vado a caricare dall'array tweets.--> 
        <?php if (count($tweets) > 0) { ?>
            <section class = "sectionToCenter">
                <!-- Link che porta alla pagina scrivi.php per scrivere un nuovo tweet -->
                <a class = "newTweetButton fontCopperplate" href="scrivi.php">Nuovo Tweet</a>
            </section>
            <div id="divBachecaTweets">
                <!-- In questa sezione l'utente potrà selezionare una data di inizio e di fine per filtrare i propri tweet. Indicherà dunque un arco temproale, e tramite uno script in JS caricato a fine pagina
                verranno mostrati solamente i tweet che sono stati pubblicati dall'utente in quel preciso arco temporale. -->
                <section class="filter-form">
                    <label class = "fontCopperplate" for="start_date">Data Inizio:</label>
                    <input type="date" id="start_date" name="start_date">
                    <label class = "fontCopperplate" for="end_date">Data Fine:</label>
                    <input type="date" id="end_date" name="end_date">
                </section>

                <section id = "tweetsSection">
                    <!-- In questa sezione vengono pubblicati tutti i tweet dell'utente. Se nell'arco temporale l'utente non ha pubblicato tweet, verrà visualizzato un messaggio di errore. -->
                    <p class="no-tweets-message">Non ci sono tweet da mostrare nell'arco temporale selezionato!</p>
                    <?php foreach ($tweets as $tweet){ ?>
                        <article class="articleTweet" data-date = <?php echo $tweet['data'] ?>>
                            <section class = "sectionUserDataTweet">
                                <p class="text-bold col-4"><?php echo "@".$_SESSION['user']['username'];?> </p>
                                <p class="fontCopperplate fontSizeBiggerBrown col-4 text-center nome"><?php echo $tweet['nome'];?></p>
                                <p class="text-italic col-4 text-end"> <?php echo $tweet['data']; ?> </p>
                            </section>

                            <section>
                                <p class = "tweetText"> <?php echo $tweet['testo']; ?> </p>
                            </section>

                        </article>
                    <?php } ?>
                </section>
            </div>
                
        <?php } else { ?>
            <!-- Qualora l'utente non avesse pubblicato ancora alcun tweet, viene mostrato un messaggio che lo invoglia a farlo e un link che lo reindirizza alla pagina scrivi.php.-->
            <section id = "noTweetsSection">
                <p class="no-tweets-message-display">Il mondo aspetta le tue parole! Scrivi un nuovo tweet e condividi i tuoi pensieri.</p>
                <a class = "newTweetButton fontCopperplate" href="scrivi.php">Nuovo Tweet</a>
            </section>
        <?php } ?>
    </main>

    <?php 
    require('Components/footer.php');
    ?>
    <script src="Resources/filter_date.js"></script>

</body>