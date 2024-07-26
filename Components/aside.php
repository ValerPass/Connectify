<aside id = "myAside" class = "col-3">
    <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
    <ul>
        <li class="fontCopperplate <?php if ($current_page == 'home.php') echo 'active-orange';?>"><a href="home.php">Presentazione</a></li>
        <div class="borderSeparatore"></div>
        <li class="fontCopperplate <?php if ($current_page == 'chi_siamo.php') echo 'active-orange';?>"><a href="chi_siamo.php">Chi siamo</a></li>
        <div class="borderSeparatore"></div>
        <li class="fontCopperplate <?php if ($current_page == 'faq.php') echo 'active-orange';?>"><a href="faq.php">FAQ</a></li>
        <div class="borderSeparatore"></div>
    </ul>
</aside>