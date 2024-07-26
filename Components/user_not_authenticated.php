<?php if (!isset($_SESSION['autenticato']) || $_SESSION['autenticato'] !== true){
    // Se l'utente che sta accedendo alla pagina scrivi.php non risulta autenticato, verrà creata una pagina apposita di errore che non gli permetterà di raggiungere la vera pagina. Infatti, ci potranno accedere dalla navbar soltanto gli utenti autenticati.
    echo "<main>
            <h1 class = 'identitàMessage fontCopperplate'>Identità non verificata</h1>
            <img class = 'dangerIcon' src='Images/danger_icon.png' alt='Immagine di un'icona reppresentante un pericolo'>
            <article class = 'articleUnauthorized'>
                <p class = 'errorParagraphMessage'>Oops! Sembra che tu non sia autenticato.</p>
                <p class = 'errorParagraphMessage'>Per accedere a questa funzionalità, è necessario effettuare il <a href='login.php'>login.</a></p>
            </article>
            <section class = 'sectionHomeIcon'>
                <a href='home.php'><img class = 'homeIcon' src='Images/home_icon.png' alt='Immagine di una casa'></a>
            </section>
        </main>";
        include('Components/footer.php');
        exit();
    }
?>