<?php 
session_start();
$pageTitle = "Chi siamo";
require_once('Components/head.php'); 
?>

<body>
    <?php require_once('Components/header.php') ?>

    <h1 class="fontCopperplate fontSizeBigger text-center">Chi siamo</h1>
    <div class="row">
        <?php require_once('Components/aside.php')?>
        <main class="col-6 mainHomepage">
            <section id = "sectionChiSiamo">
                <article class="articleHomepageBody">
                    <h2>L'idea</h2>
                    <p>Fondato a giugno del 2024, <strong>Connectify</strong> è nato dall'idea di <strong>Stefan Patru</strong>, un appassionato di tecnologia e innovazione che studia al Politecnico di Torino. L'applicazione web è stata realizzata per il progetto finale del corso di Progettazione di Servizi Web e Reti di Calcolatori, Ingengeria Gestionale L8.</p>
                </article>

                <article class="articleHomepageBody">
                    <h2>I Nostri Valori</h2>
                    <ul>
                        <li class="marginList"><strong>Inclusività:</strong> Credo che tutti debbano avere la possibilità di esprimersi liberamente.</li>
                        <li class="marginList"><strong>Sicurezza:</strong> La sicurezza degli utenti è la priorità di Connectify.</li>
                        <li class="marginList"><strong>Innovazione:</strong> Mi impegnerò per migliorare continuamente la piattaforma.</li>
                    </ul>
                </article>
            </section>
        </main>
    </div>
    
    <?php require_once('Components/footer.php')?>
</body>