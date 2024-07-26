<?php
session_start();
require('db_connection_normale.php');

if (mysqli_connect_errno()) {
    // Messaggio di errore nel caso in cui ci fosse la variabile 'error' nell'array asscoiativo $_SESSION.
    $_SESSION['error'] = "Si è verificato un errore. Il collegamento al DB non è andato a buon fine.";
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se isset($_POST['login']) restituisce true, significa che l'utente ha inviato il form di autenticazione tramite il bottone Invia, ovvero sta provando ad autenticarsi su Connectify.
    if (isset($_POST['login'])) {
        $username = $_POST['user'];
        $pwd = $_POST['pwd'];
        
        // Verifico che esistano e che non siano vuote le variabili contenenti lo username e la password.
        if (!isset($username) || !isset($pwd) || empty($username) || empty($pwd)){
            $_SESSION['error'] = "Tutti i campi sono obbligatori.";
            header("Location: ../login.php");
            exit;
        }
        
        // Query per prendere le informazioni dell'utente che sta provando a loggarsi sul sito.
        $query = "SELECT username, pwd, nome, cognome, data, indirizzo FROM utenti WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $db_username, $db_password, $firstName, $surname, $birthdate, $address);
        mysqli_stmt_fetch($stmt);

        // Verifico che esista effettivamente un utente con lo username indicato all'interno del DB e verifico che la password inserita sia effettivamente corretta e corrisponda alla password inserita dall'utente nel momento della registrazione.
        if ($db_username != null && $pwd == $db_password) {
            // Password corretta, imposta la sessione
            // Creo la variabile 'user' nell'array associativo $_SESSION, che sarà a sua volta un array associativo dove per ogni campo sarà associata l'informazione personale dell'utente loggato.
            $_SESSION['user'] = [
                'username' => $db_username,
                'firstname' => $firstName,
                'surname' => $surname,
                'birthdate' => $birthdate,
                'address' => $address
            ];
            // Se l'utente inserisci i dati corretti e si logga, in $_SESSION creo la variabile 'autenticato' che sarà booleano e sarà true se l'utente è effettivamente autenticato.
            $_SESSION['autenticato'] = true;
        
            // Imposta un cookie per ricordare l'ultimo username usato con successo
            setcookie('last_username', $db_username, time() + (16 * 3600), "/"); // 16 ore

            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            $_SESSION['success'] = "Login effettuato con successo! Ora sei pronto a condividere i tuoi pensieri su Connectify.";

            header("Location: ../bacheca.php");
            exit();

        } else {
            // Se l'autenticazione non va a buon fine, imposto un messaggio di errore prima di reindirizzare l'utente alla pagina di login.
            $_SESSION['error'] = 'Le credenziale inserite non sono valide. Riprova!';
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: ../login.php");
            exit();
        }
    }
    // Altrimenti, se isset($_POST['login']) restituisce false e isset($_POST['skip']) restituisce true significa che l'utente ha usato il pulsante "Continua senza autenticarsi" nella pagina di login, pertanto esso non verrà autenticato e verrà reindirizzato
    // alla pagina scopri.php con i tweet caricati da tutti gli utenti del sito, ovviamente con le rispettive funzionalità limitate.

    elseif (isset($_POST['skip'])) {
        header("Location: ../scopri.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
