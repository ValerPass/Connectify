<?php 
session_start();
$pageTitle = "Login";
require_once('Components/head.php'); 
?>

<body>
    <?php 
    require_once('Components/header.php');
    ?>
    <?php
        require_once('Components/user_authenticated.php');
        include('Components/errorMessage.php');
        require('Components/noscript.php');
        // Quando l'utente fa l'accesso su Connectify e va a buon fine, viene creato un cookie (assegnando la variabile $_COOKIE['last_username']) che conterrà lo username
        // dell'utente che ha fatto l'accesso sul sito. Quando vado nella pagina del login, verificato se è presente questo cookie (che quando viene creata gli viene imposta una scadenza di 16h)
        // Se dovesse esistere, allora lo assegno alla variabile $last_username e la userò per precompilare il campo dello username nel form del login. Altrimenti, se il cookie sarà già scaduto, 
        // non il campo "username" non verrò precompilato in alcun modo con l'utente che dovrà riscrivere il proprio username.
        if (isset($_COOKIE['last_username'])) {
            $last_username = $_COOKIE['last_username'];
        } 
        else {
            $last_username = '';
        }
        
    ?>
    <main id="mainRegistrazione">
        <h1 class="fontCopperplate fontSizeBigger">Login</h1>
        <article class="formLayout">
            <form id = "loginForm" method="post" action="Helpers/login_process.php">
                <!-- Creo un bottone Continua senza autenticarsi. Se l'utente lo clicca salterà il processo di login e verrà reindirizzato direttamente alla pagina scopri.php.-->
                <button class = "fontCopperplate specialButton" name = "skip" value='skip' type = "submit">Continua senza autenticarsi</button>
                <section class="formSection">
                    <label class = "labelMargin" for="user">Username</label>
                    <!-- Se esiste il cookie con il last_username dell'utente allora verrà assegnato all'attributo value del tag input. -->
                    <input type="text" name="user" id="user" value="<?php echo $last_username;?>">
                    <span class="errorInputComp" id="nicknameError"></span>
                </section>

                <section class="formSection">
                    <label class = "labelMargin" for="pwd">Password</label>
                    <input type="password" name="pwd" id="pwd">
                    <span class="errorInputComp" id="passwordError"></span>
                </section>

                <section class="buttonSection">
                    <button class="fontCopperplate" name = "res" type="reset">Cancella</button>
                    <button class="fontCopperplate" type="submit" name="login" value='login'>Invia</button>
                </section>
            </form>
            <p>Non sei ancora registrato? <a href="registrazione.php">Clicca qui!</a></p>

        </article>

    </main>
    
    <?php 
    require_once('Components/footer.php');
    ?>
    <script src="Resources/login_validation.js"></script>
</body>