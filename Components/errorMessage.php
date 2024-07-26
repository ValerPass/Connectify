<?php 
if (isset($_SESSION['error'])) {
    echo '<section class = "errorMessageSection">';
    echo "<p class = 'warningMessage'>" . $_SESSION['error'] . "</p>";
    echo '</section>';
    unset($_SESSION['error']);
}
?>