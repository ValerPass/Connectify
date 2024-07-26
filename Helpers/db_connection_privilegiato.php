<?php
// Connessione al DB dell'utente che può effettuare operazioni di SELECT, INSERT, UPDATE.

$server = $_SERVER['SERVER_ADDR'];
$username = "privilegiato";
$password = "SuperPippo!!!";
$db = "social_network";

$conn_priv = mysqli_connect($server, $username, $password, $db)
?>