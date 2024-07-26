<?php 
session_start();
$pageTitle = "Home";
require_once('Components/head.php'); 
?>

<body>
    <?php require_once('Components/header.php') ?>

    <?php
        include('Components/successMessage.php');
    ?>
    <h1 class="fontCopperplate fontSizeBigger text-center">Benvenuto su Connectify</h1>
    <div class="row">
        <?php require_once('Components/aside.php')?>
        <main class="col-6 mainHomepage">
            <section id = "sectionPresentazione">
                <article class="articleHomepageBody">
                    <h2>Condivisione Veloce</h2>
                    <p>Pubblica aggiornamenti in pochi secondi.</p>
                </article>
                
                <article class="articleHomepageBody">
                    <h2>Segui i Tuoi Amici</h2>
                    <p>Resta aggiornato sulle attività dei tuoi amici e scopri nuovi contatti.</p>
                </article>

                <article class="articleHomepageBody">
                    <h2>Esplora Contenuti</h2>
                    <p>Scopri nuovi contenuti e trend popolari nella tua rete.</p>
                </article>
                
                <article class="articleHomepageBody">
                    <h2>Unisciti a Noi</h2>
                    <p>Non perdere l'occasione di far parte della nostra comunità. Registrati ora e inizia a connetterti!</p>
                </article>
                <?php if(!isset($_SESSION['autenticato']) || $_SESSION['autenticato'] !== true){?>
                <section class = "sectionToCenter">
                    <a class = "newTweetButton fontCopperplate" href="registrazione.php">Registrati</a>
                </section>
                <?php } ?>
            </section>

            <section id="testimonianze">
                <h2>Testimonianze</h2>
                <blockquote>
                    <p>"Questo social network ha cambiato il modo in cui mi connetto con i miei amici. Lo adoro!" - Anna Bianchi</p>
                </blockquote>
                <blockquote>
                    <p>"Un'esperienza fantastica! Facile da usare e pieno di contenuti interessanti e innovativi... provatelo subito!" - Stefan Patru</p>
                </blockquote>
            </section>

        </main>
    </div>
    



    <?php require_once('Components/footer.php')?>
</body>