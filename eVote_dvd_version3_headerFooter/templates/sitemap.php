<?php
require_once __DIR__ . '/../templates/header1.inc.php';
print '<title>EVOTE DVD - site map</title>';
require_once __DIR__ . '/../templates/header2.inc.php';
//-------------------------------------------
?>


<nav>
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>

        <li>
            <a href="index.php?action=about">About Us</a>
        </li>

        <li>
            <a href="index.php?action=list">DVD ratings</a>
        </li>

        <li>
            <a href="index.php?action=contact">Contact Us</a>
        </li>

        <li>
            <a href="index.php?action=sitemap" class="current_page">Site Map</a>
        </li>
    </ul>
</nav>

<h1>
    Site Map
</h1>

<ul>
    <li><a href="index.php">Home</a>
    <li><a href="about.php">About us</a>
    <li><a href="list.php">DVD ratings</a>
    <li><a href="contact.php">Contact us</a>
    <li><a href="sitemap.php">Site Map</a>
</ul>


<?php
//-------------------------------------------
require_once __DIR__ . '/../templates/footer.inc.php';

//  don't close the PHP tags