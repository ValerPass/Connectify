<?php
session_start();
// Quando l'utente effettua il logout cliccando sul pulsante apposito nella navbar, viene indirizzato a questa pagina in cui viene distrutta la sessione.
// Dopo di che ne viene creata un'altra per assegnare il messaggio di successo che verrà mostrato nella home una volta che il processo di logout è andato a buon fine.
if (!isset($_SESSION['autenticato']) || $_SESSION['autenticato'] !== true){
    $pageTitle = "Logout";
    require_once('Components/head.php');
    require_once('Components/header.php'); 
    require_once('Components/user_not_authenticated.php');
}
$_SESSION = array();
session_destroy();
session_start();
$_SESSION['success'] = "Il logout è stato effettuato con successo!";
header("Location: home.php");

?>