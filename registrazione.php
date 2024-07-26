<?php 
session_start();
$pageTitle = "Registrazione";
require_once('Components/head.php'); 
?>

<body>
    <?php 
    require_once('Components/header.php');
    require_once('Components/user_authenticated.php');
    include('Components/errorMessage.php');
    require('Components/noscript.php');
    ?>
    
    <main id="mainRegistrazione">
        <h1 class="fontCopperplate fontSizeBigger">Registrazione</h1>
        <article class="formLayout">
            <form method="post" action="Helpers/registration_process.php" id="registrationForm">
                <div class="divTwoInputs">
                    <section class="formSection col-5">
                        <label class = "labelMargin" for="name">Nome</label>
                        <input type="text" name="name" placeholder = "Il tuo nome" id="name">
                        <span class="errorInputComp" id="nameError"></span>
                    </section>

                    <section class="formSection col-5">
                        <label class = "labelMargin" for="surname">Cognome</label>
                        <input type="text" placeholder = "Il tuo cognome" name="surname" id="surname">
                        <span class="errorInputComp" id="surnameError"></span>
                    </section>
                </div>

                <section class="formSection">
                    <label class = "labelMargin" for="address">Indirizzo</label>
                    <input type="text" placeholder = "Corso Duca Degli Abruzzi, 24" name="address" id="address">
                    <span class="errorInputComp" id="addressError"></span>
                </section>

                <section class="formSection">
                    <label class = "labelMargin" for="birthdate">Data di nascita</label>
                    <input type="text" name="birthdate" id="birthdate" placeholder = "aaaa-mm-gg">
                    <span class="errorInputComp" id="birthdateError"></span>
                </section>

                <section class="formSection">
                    <label class = "labelMargin" for="nick">Username</label>
                    <input type="text" placeholder="Il tuo nickname" name="nick" id="nick">
                    <span class="errorInputComp" id="nicknameError"></span>
                </section>

                <section class="formSection">
                    <label class = "labelMargin" for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <span class="errorInputComp" id="passwordError"></span>
                </section>

                <section class="buttonSection">
                    <button class="fontCopperplate" id = "res" type="reset">Cancella</button>
                    <button class="fontCopperplate" id = "send" type="submit">Invia</button>

                </section>
            </form>

            <p>Sei già registrato? <a href="login.php">Clicca qui!</a></p>
            
        </article>
    </main>

    <?php 
    require_once('Components/footer.php');
    ?>
    <script src="Resources/registration_validation.js"></script>
</body>