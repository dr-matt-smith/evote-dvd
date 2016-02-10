<?php
require_once __DIR__ . '/../templates/header1.inc.php';
print '<title>EVOTE DVD - about page</title>';
require_once __DIR__ . '/../templates/header2.inc.php';
//-------------------------------------------
?>


<nav>
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>

        <li>
            <a href="index.php?action=about" class="current_page">About Us</a>
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
    About us
</h1>

<p>
    We are SmithIT.com.
</p>
<p>
    We are based in Dublin.
</p>
<p>
    We were established in 2007.
</p>
<p>
    We sell computers and computer services - and host this great DVD voting site!.
</p>


<?php
//-------------------------------------------
require_once __DIR__ . '/../templates/footer.inc.php';

//  don't close the PHP tags