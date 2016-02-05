<?php
//-------------------------------------------------
// default style strings to empty, if not set
if (empty($indexLinkStyle)){
    $indexLinkStyle = '';
}
if (empty($aboutLinkStyle)){
    $aboutLinkStyle = '';
}
if (empty($listLinkStyle)){
    $listLinkStyle = '';
}
if (empty($contactLinkStyle)){
    $contactLinkStyle = '';
}
if (empty($sitemapLinkStyle)){
    $sitemapLinkStyle = '';
}

/* here is the same logic, using the '?' ternary operator and 'isset()' function
$indexLinkStyle = isset($homeLinkStyle) ? $homeLinkStyle : '';
$aboutLinkStyle = isset($aboutLinkStyle) ? $aboutLinkStyle : '';
$listLinkStyle = isset($listLinkStyle) ? $listLinkStyle : '';
$contactLinkStyle = isset($contactLinkStyle) ? $contactLinkStyle : '';
$sitemapLinkStyle = isset($sitemapLinkStyle) ? $sitemapLinkStyle : '';
*/
//-------------------------------------------------
?>

<nav>
    <ul>
        <li>
            <a href="/" class="<?= $indexLinkStyle ?>">Home</a>
        </li>

        <li>
            <a href="/?action=about" class="<?= $aboutLinkStyle ?>">About Us</a>
        </li>

        <li>
            <a href="/?action=list" class="<?= $listLinkStyle ?>">DVD ratings</a>
        </li>

        <li>
            <a href="/?action=contact" class="<?= $contactLinkStyle ?>">Contact Us</a>
        </li>

        <li>
            <a href="/?action=sitemap" class="<?= $sitemapLinkStyle ?>">Site Map</a>
        </li>
    </ul>
</nav>
