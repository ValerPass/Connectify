<?php
    if (isset($_SESSION['success'])) {
        echo '<section class = "successMessageSection">';
        echo "<p class = 'successMessage'>" . $_SESSION['success'] . "</p>";
        echo '</section>';
        unset($_SESSION['success']);
    }
?>