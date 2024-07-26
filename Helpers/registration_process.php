<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifico se esistono tutte le variabili che l'utente invia con il form.
    if (!isset($_POST['name']) || !isset($_POST['surname']) || !isset($_POST['address']) || !isset($_POST['birthdate']) || !isset($_POST['nick']) || !isset($_POST['password'])){
        // Messaggio di errore
        $_SESSION['error'] = "La registrazione non è andata a buon fine! Tutti i campi sono obbligatori.";
        header("Location: ../registrazione.php");
        exit();
    }
    
    else{
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $address = $_POST["address"];
        $birthdate = $_POST["birthdate"];
        $nickname = $_POST["nick"];
        $pwd = $_POST["password"];

    }
    
    // Verifico che l'utente abbia correttamente completato i campi del form x la registrazione
    if (empty($name) || empty($surname) || empty($address) || empty($birthdate) || empty($nickname) || empty($pwd)) {
        // Messaggio di errore
        $_SESSION['error'] = "La registrazione non è andata a buon fine! Tutti i campi sono obbligatori.";
        header("Location: ../registrazione.php");
        exit();
    }

    // Espressioni regolari che servono x verificare la correttezza dei campi di input nel form di registrazione 
    $namePattern = '/^[A-Z][a-zA-Z ]{1,11}$/';
    $surnamePattern = '/^[A-Z][a-zA-Z ]{1,15}$/';
    $birthdatePattern = '/^\d{4}-(0?[1-9]|1[0-2])-(0?[1-9]|[12][0-9]|3[01])$/';
    $addressPattern = '/^(Via|Corso|Largo|Piazza|Vicolo) [a-zA-Z ]+ \d{1,4}$/';
    $nicknamePattern = '/^[a-zA-Z][a-zA-Z0-9-_]{3,9}$/';
    $passwordLengthPattern = '/^[a-zA-Z0-9#!?@%^&*+=]{8,16}$/';
    $passwordUppercasePattern = '/[A-Z]/';
    $passwordLowercasePattern = '/[a-z]/';
    $passwordDigitPattern = '/.*\d.*\d.*/';    
    $passwordSpecialPattern = '/.*[#!?@%^&*+=].*[#!?@%^&*+=].*/';

    // Per ogni campo del form, utilizzo preg_match() per verificare che il testo inserito dall'utente rispetti effettivamente l'espressione regolare associata.
    // Se non lo rispetta, creo un messaggio di errore nella variabile $_SESSION e reindirizzo l'utente sulla pagina di registrazione.

    if (!preg_match($namePattern, $name)) {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. Il nome inserito non è valido! Deve essere formato da minimo 2 e massimo 12 caratteri, con solo lettere ed il carattere spazio come caratteri
        accettabili e deve necessariamente iniziare con una lettera maiuscola";
        header("Location: ../registrazione.php");
        exit();
    }

    if (!preg_match($surnamePattern, $surname)) {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. Il cognome inserito non è valido! Deve essere formato da minimo 2 e massimo 16 caratteri, con solo lettere ed il carattere spazio come caratteri
        accettabili e deve necessariamente iniziare con una lettera maiuscola";
        header("Location: ../registrazione.php");
        exit();
    }


    # Implemento un controllo che non permette a utenti con età inferiore a 13 anni di iscriversi su Connectify.
    # L'età di 13 anni è stata scelta come soglia minima perchè si tratta dell'età richiesta per la maggior parte dei social network presenti sul web.

    function calculateAge($birthdate) {
        $today = date('Y-m-d');
        $today_parts = explode('-', $today);
        $currentYear = (int)$today_parts[0];
        $currentMonth = (int)$today_parts[1];
        $currentDay = (int)$today_parts[2];

        $birthday_parts = explode('-', $birthdate);
                
        $birthYear = (int)$birthday_parts[0];
        $birthMonth = (int)$birthday_parts[1];
        $birthDay = (int)$birthday_parts[2];

        $age = $currentYear - $birthYear;
        
        if ($currentMonth < $birthMonth || ($currentMonth == $birthMonth && $currentDay < $birthDay)) {
            $age--;
        }
        
        return $age;
    }

    $age = calculateAge($birthdate);
    // Se l'utente ha meno di 13 anni, non potrò registrarsi su Connectify.
    if ($age < 13) {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. Per poterti registrare su Connectify, l'età minima richiesta è di 13 anni.";
        header("Location: ../registrazione.php");
        exit();
    }

    if (!preg_match($birthdatePattern, $birthdate)) {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. La data inserita non è valida! Deve essere nella forma “aaaa-mm-gg” (dove il valore 0 in posizione più significativa nel mese e nel giorno può
        eventualmente essere omesso)";
        header("Location: ../registrazione.php");
        exit();
    }

    // Funzione che uso per verificare che l'anno ricevuto in input sia bisestile o meno

    function annoBisestile($anno){
        return $anno % 4 == 0;
    }

    // validateDate() riceve una data in input e verifica che sia corretta. Corretta significa che abbia un senso logico, quindi in un mese formato da 30 giorni, l'utente non potrà indicare come giorno di nascita il 31.

    function validateDate($date){
        $date_parts = explode("-", $date);
        $anno = (int)$date_parts[0];
        $mese = (int)$date_parts[1];
        $giorno = (int)$date_parts[2];

        $daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if (annoBisestile($anno))
            $daysInMonth[1] = 29;
        
        $giornoValido = false;
        $maxDays = $daysInMonth[$mese - 1];
        
        if ($giorno > $maxDays) {
            $giornoValido = false;
        } 
        else {
            $giornoValido = true;
        }
        
        return $giornoValido;
    }

    if (validateDate($birthdate) == false){
        $_SESSION['error'] = "La data di nascita inserita non è valida.";
        header("Location: ../registrazione.php");
        exit();
    }

    if (!preg_match($addressPattern, $address)) {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. L'indirizzo inserito non è valido! Deve essere nella forma “Via/Corso/Largo/Piazza/Vicolo nome numeroCivico”, dove nome può contenere caratteri alfabetici e spazi mentre numeroCivico
        è un numero naturale composto da 1 a 4 cifre decimali";
        header("Location: ../registrazione.php");
        exit();
    }

    if (!preg_match($nicknamePattern, $nickname)) {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. Lo username inserito non è valido! Deve essere una stringa lunga da 4 a 10 caratteri, con solo lettere, numeri e - o _ come valori ammessi e deve cominciare con un
        carattere alfabetico";
        header("Location: ../registrazione.php");
        exit();
    }

    // Per la password uso una combinazione di espressioni regolare legate da || perchè crearne un'unica per tutte le richieste sarebbe risultato troppo complicato.

    if (!preg_match($passwordLengthPattern, $pwd) || !preg_match($passwordUppercasePattern, $pwd) || !preg_match($passwordLowercasePattern, $pwd) || !preg_match($passwordDigitPattern, $pwd) || !preg_match($passwordSpecialPattern, $pwd)){
        $_SESSION['error'] = "La registrazione non è andata a buon fine. La password inserita non è valida! deve essere una stringa lunga da 8 a 16 caratteri, che puo' contenere
        lettere, numeri e caratteri speciali, e deve contenere almeno 1 lettera maiuscola, 1 lettera minuscola,
        2 numeri e 2 caratteri speciali tra i seguenti (#!?@%^&*+=)";
        header("Location: ../registrazione.php");
        exit();
    }


    // Controllo se lo username esiste già
    require('db_connection_normale.php');
    if (mysqli_connect_errno()){
        $_SESSION['error'] = "Si è verificato un errore. Il collegamento al DB non è andato a buon fine.";
        header("Location: ../registrazione.php");
        exit();
    }

    // Faccio una verifica per vedere se lo username che l'utente ha scelto per registrarsi è stato già utilizzato da un utente registrato in precedenza.
    // Qualora fosse questo il caso, verrà indicato un messaggio di errore all'utente che gli spiega il problema e chiede di scegliere uno username nuovo.
    // Questo viene fatto perchè lo username è univoco su Connectify, essendo anche username chiave primaria della tabella 'utenti'.
    $query = "SELECT nome FROM utenti WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $nickname);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nome);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($nome != null) {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. Lo username da lei scelto risulta già registrato sulla nostra piattaforma. E' pregato
        di ripetere il processo di registrazione optando per uno username diverso.";
        mysqli_close($conn);
        header("Location: ../registrazione.php");
        exit();
    }

    if (!mysqli_close($conn)){
        $_SESSION['error'] = "La chiusura della connessione al DB non è andata a buon fine.";
        header("Location: ../registrazione.php");
        exit();
    }

    require('db_connection_privilegiato.php');
    if (mysqli_connect_errno()){
        $_SESSION['error'] = "Si è verificato un errore. Il collegamento al DB non è andato a buon fine.";
        header("Location: ../registrazione.php");
        exit();
    }

    // Inserisco l'utente con tutte le informazioni e tutti i dati che l'utente ha indicato nel form della registrazione.
    $query = "INSERT INTO utenti (nome, cognome, data, indirizzo, username, pwd) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn_priv, $query);
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $surname, $birthdate, $address, $nickname, $pwd);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Registrazione avvenuta con successo! Ora puoi effettuare il login.";
        mysqli_stmt_close($stmt);
        mysqli_close($conn_priv);
        header("Location: ../home.php");
        exit();
    } 
    else {
        $_SESSION['error'] = "La registrazione non è andata a buon fine. Si è verificato un errore durante l'inserimento dei dati all'interno del DB.";
        mysqli_stmt_close($stmt);
        mysqli_close($conn_priv);
        header("Location: ../registrazione.php");
        exit();
    } 
}
else {
    header("Location: ../registrazione.php");
}
?>