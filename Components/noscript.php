<?php
$current_page = basename($_SERVER['PHP_SELF']); 
?>
<noscript>
    <p  id = "noscript">
    Attenzione! La pagina <?php echo $current_page;?> usa JavaScript per l'aggiornamento del contenuto in tempo reale.
    Il tuo browser non supporta JavaScript (oppure ne è stata disabilitata l'esecuzione) e quindi tale funzionalità non sarà disponibile.
    </p>
</noscript>