<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!isset($_POST['testo']) || empty($_POST['testo'])){
        $_SESSION['error'] = "La pubblicazione del tweet non è andata a buon fine!";
        header("Location: ../scrivi.php");
        exit();
    }
    else{
        require('db_connection_privilegiato.php');
        // Prendo lo username dell'utente loggato al momento
        $user_name = $_SESSION['user']['username'];
        // Testo del tweet che l'utente sta inserendo e che si trova in $_POST avendo inviato il form con method="post".
        // Verifico che il testo del tweet non sia vuoto e non sia formato da più di 140 caratteri.
        
        if (!isset($_POST['testo']) || empty($_POST['testo'])){
            $_SESSION['error'] = "Si è verificato un errore. Il testo del tweet non può essere vuoto!";
            header("Location: ../scrivi.php");
            exit();
        }
        $testo_tweet = $_POST['testo'];
        if (strlen($testo_tweet) > 140){
            $_SESSION['error'] = "Si è verificato un errore. Il testo del tweet non può essere formato da più di 140 caratteri.";
            header("Location: ../scrivi.php");
            exit();
        }

        // Data in formato Y-m-d H:i:s del server. Corrisponderà poi alla data in cui il tweet è stato pubblicato.
        $data = date('Y-m-d H:i:s');

        if (mysqli_connect_errno()){
            $_SESSION['error'] = "Si è verificato un errore. Il collegamento al DB non è andato a buon fine.";
            header("Location: ../scrivi.php");
            exit();
        }
        // Inserisco il tweet all'interno della tabella tweets.
        $query = "INSERT INTO tweets (username, data, testo) VALUES (?, ?, ?)";
        mysqli_set_charset($conn_priv, "utf8");
        $stmt = mysqli_prepare($conn_priv, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $user_name, $data, $testo_tweet);
        
        // Se l'inserimento del tweet nella tabella va a buon fine, allora creo un messaggio di successo e reindirizzo l'utente alla propria bacheca personale in cui potrà leggere il tweet appena inserito.
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['success'] = "Il tweet è stato pubblicato con successo! Lo puoi trovare nella tua bacheca.";
            mysqli_stmt_close($stmt);
            mysqli_close($conn_priv);
            header("Location: ../bacheca.php");
            exit();
        } 
        // Se l'inserimento non va a buon fine, allora creo un messaggio di errore e reindirizzo l'utente nuovamente alla pagina scrivi.php.
        else {
            $_SESSION['error'] = "La pubblicazione del tweet non è andata a buon fine. Si è verificato un errore durante l'inserimento dei dati all'interno del DB.";
            mysqli_stmt_close($stmt);
            mysqli_close($conn_priv);
            header("Location: ../scrivi.php");
            exit();
        } 
    }
}

else{
    header("Location: ../scrivi.php");
}


?>