<?php
// Connessione al DB dell'utente che può solo effettuare operazioni di SELECT.
$server = $_SERVER['SERVER_ADDR'];
$username = "normale";
$password = "posso_leggere?";
$db = "social_network";

$conn = mysqli_connect($server, $username, $password, $db)
?>