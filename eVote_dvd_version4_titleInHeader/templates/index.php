<?php
require_once __DIR__ . '/../templates/header.inc.php';
//-------------------------------------------
?>

<nav>
    <ul>
        <li>
            <a href="index.php" class="current_page">Home</a>
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
            <a href="index.php?action=sitemap">Site Map</a>
        </li>
    </ul>
</nav>

<h1>
Welcome to SmithIT Home Page
</h1>

<p>
This site offers you the chance to VOTE on your favourite DVD films ...
</p>


<?php
//-------------------------------------------
require_once __DIR__ . '/../templates/footer.inc.php';

//  don't close the PHP tags