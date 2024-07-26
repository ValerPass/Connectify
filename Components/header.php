<header id="myHeader">
    <div class= "col-7" id="headerDiv">
        <?php
        if (isset($_SESSION['autenticato']) && $_SESSION['autenticato'] === true){
            $current_user = $_SESSION['user']['username'];
            require('Helpers/db_connection_normale.php');
            // Scrivo una query per ottenere il testo dell'ultimo tweet che l'utente loggato ha pubblicato
            $query = "SELECT t.testo
            FROM tweets as t, utenti as u
            WHERE t.username = u.username
            AND t.username = ?
            ORDER BY t.data DESC
            LIMIT 1";
            mysqli_set_charset($conn, "utf8");
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 's', $current_user);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $testo);
            if (mysqli_stmt_fetch($stmt)){
                if (strlen($testo) < 30)
                    $testo_troncato = $testo;
                else{
                    // Uso preg_match() con l'espressione regolare /^.{0,30}/' per ottenere i primi 30 caratteri dell'ultimo tweet e poterlo caricare all'interno della navbar
                    preg_match('/^.{0,30}/', $testo, $results);
                    $testo_troncato = $results[0];
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        ?>
        
        <!-- Nella sezione sottostante stampo se l'utente non è loggato un messaggio di benvenuto. Altirmenti stampo il nome dell'utente loggato e i primi 30 caratteri dell'ultimo tweet dell'utente loggato.-->
        <section id="headerSection">
            <p class="welcomeMessage">Hei @<?php echo $_SESSION['user']['username']?>! Bentornato</p>
            <?php if (isset($testo_troncato)){?>
            <section id="sectionWelcomeMessage">
                <p class="welcomeMessage">Ultimo tweet: </p>
                <p class="colorBrighter welcomeMessage">
                <?php echo $testo_troncato; if (strlen($testo_troncato) == 30) echo "..."; ?>
                </p>
            </section>
            <?php } ?>
        </section>
        <?php } else {
        ?>
        <section id="headerSection">
            <p class="welcomeMessage">Unisciti alla nostra community!</p>
        </section>
        <?php } ?>
        
  
        <img id = "logo" src="Images/logo.png" alt="Logo di Connectify">
    </div>
    <nav class = "col-5" id = "myNav">
        <?php 
        // Utilizzo $_SERVER['PHP_SELF'] per ottenere il percorso del file corrente rispetto alla root del documento.
        // basename() mi restituisce solo il nome del file, ignorando il resto del percorso.
        $current_page = basename($_SERVER['PHP_SELF']);
        $authenticated =  isset($_SESSION['autenticato']) && $_SESSION['autenticato'] === true
        ?>
        <!-- Navbar con tutte le voci per andare nelle diverse pagine. La classe .active serve per evidenziare la pagina sulla quale mi trovo nel momento.
        La classe .disabled serve per non permettere di accedere a determinate pagine a seconda se l'utente è autenticato o meno. -->
        <a class = "ancoraNavigazione fontCopperplate <?php if ($current_page == 'home.php' || $current_page == 'chi_siamo.php' || $current_page == 'faq.php') echo 'active'; ?>" href="home.php">Home</a>
        <a class = "ancoraNavigazione fontCopperplate <?php if ($current_page == 'registrazione.php') echo 'active'; ?> <?php if ($authenticated) echo 'disabled'; ?>" href="registrazione.php">Registrati</a>
        <a class = "ancoraNavigazione fontCopperplate <?php if ($current_page == 'login.php') echo 'active' ; ?> <?php if ($authenticated) echo 'disabled'; ?>" href="login.php">Login</a>
        <a class = "ancoraNavigazione fontCopperplate <?php if ($current_page == 'scopri.php') echo 'active'; ?>" href="scopri.php">Scopri</a>
        <a class = "ancoraNavigazione fontCopperplate <?php if ($current_page == 'bacheca.php') echo 'active'; ?> <?php if (!$authenticated) echo 'disabled'; ?>" href="bacheca.php">Bacheca</a>
        <a class = "ancoraNavigazione fontCopperplate <?php if ($current_page == 'scrivi.php') echo 'active'; ?> <?php if (!$authenticated) echo 'disabled'; ?>" href="scrivi.php">Scrivi</a>
        <a class = "ancoraNavigazione fontCopperplate <?php if ($current_page == 'logout.php') echo 'active'; ?> <?php if (!$authenticated) echo 'disabled'; ?>" href="logout.php">Logout</a>

    </nav>
</header>