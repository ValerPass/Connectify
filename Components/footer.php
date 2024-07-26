<footer id="myFooter">
    <?php
    // Utilizzo $_SERVER['PHP_SELF'] per ottenere il percorso del file corrente rispetto alla root del documento.
    // basename() mi restituisce solo il nome del file, ignorando il resto del percorso.
    $current_page = basename($_SERVER['PHP_SELF']); 
    ?>
    <p class="pFooter">© Connectify - <?php echo $current_page;?></p>
    <p class="pFooter">Stefan Patru - 300409</p>
</footer>