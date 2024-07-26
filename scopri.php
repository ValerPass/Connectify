<?php 
session_start();
$pageTitle = "Scopri";
require_once('Components/head.php'); 
?>

<body>
    <?php require_once('Components/header.php');
    require('Components/noscript.php');
    include('Helpers/db_connection_normale.php');
    // Query che mi serve per ottenere tutti i tweet esistenti su Connectify.
    // Faccio il join tra tweets e utenti per potermi prendere anche il nome dell'utente che ha pubblicato il tweet, per ogni tweet.
    // Metto ORDER BY t.data DESC affinchè quando vado a pubblicare i tweet nella pagina, essi vengano visualizzati in ordine dal più recente al più datato.
    $query = "SELECT t.data, t.testo, t.username, u.nome
    FROM tweets t, utenti u
    WHERE u.username = t.username 
    ORDER BY t.data DESC";

    mysqli_set_charset($conn, "utf8");
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $tweet_date, $tweet_text, $tweet_username, $tweet_name);

    // Inizializza un array per conservare i tweet
    $tweets = array();
    while (mysqli_stmt_fetch($stmt)) {
    # tweets[] = aggiunge l'elemento in ultima posizione + 1 del mio array.
    $tweets[] = [
        'data' => $tweet_date,
        'testo' => $tweet_text,
        'username' => $tweet_username,
        'nome' => $tweet_name
    ];
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    ?>
    <main>
        <h1 class = "fontCopperplate fontSizeBigger text-center">Scopri i nuovi tweet</h1>
        <section class="filter-form-word">
            <!-- Aggiungo un campo di input type="text" all'interno di cui l'utente potrà indicare una parola/frase, e tramite uno script in JS verranno filtrati e visualizzati 
            solamente i tweet che contengono la frase/parola all'interno del proprio testo.--> 
            <input type = "text" placeholder="Cerca una parola..." id="parolaTweetFilter">
            <img id = "lensLogo" src="Images/lens.png" alt="Immagine di una lente di ingrandimento">
        </section>
        <section id = "tweetsSection">
            <p class="no-tweets-message">Non sono presenti tweet contenenti la parola indicata!</p>
            <?php foreach ($tweets as $tweet){ ?>
                <article class="articleTweetScopri">
                    <section class = "sectionUserDataTweet">
                        <p class="text-bold col-4">@<?php echo $tweet['username']; ?> </p>
                        <p class="fontCopperplate fontSizeBiggerBrown col-4 text-center nome"><?php echo $tweet['nome'];?></p>
                        <p class="text-italic col-4 text-end"> <?php echo $tweet['data']; ?> </p>
                    </section>
                    <section>
                        <p class = "tweetText"> <?php echo $tweet['testo']; ?> </p>
                    </section>

                </article>
            <?php } ?>
        </section>
    </main>

    <?php 
    require_once('Components/footer.php');
    ?>
    <script src="Resources/filter_words.js"></script>
</body>