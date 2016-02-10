<?php
require_once __DIR__ . '/../templates/header.inc.php';
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
            <a href="index.php?action=contact" class="current_page">Contact Us</a>
        </li>

        <li>
            <a href="index.php?action=sitemap">Site Map</a>
        </li>
    </ul>
</nav>

<h1>
    Contact us
</h1>

<h3>Address</h3>
<p>
    SmithIT.com,
<p>
    c/o ITB Learning and Innovation Centre,
    <br/>
    Blanchardstown Road North,
    <br/>
    Blanchardstown,
    <br/>
    Dublin 15
    <br/>

</p>

<h3>Telephone</h3>
<p>
    01 - 885 - 1000
</p>

<h3>Email</h3>
<p>
    <a href="mailto:enquiries@smithit.com">enquiries@smithit.com</a>
</p>


<?php
//-------------------------------------------
require_once __DIR__ . '/../templates/footer.inc.php';

//  don't close the PHP tags