<!doctype html>
<html lang="en">
<head>
    <title>EVOTE DVD - DVD listings</title>
    <meta charset="utf-8">
    <style>
        @import "css/basic.css";
        @import "css/nav.css";
        @import "css/footer.css";
    </style>
</head>
<body>

<header>
    <img src="images/smithit_logo.gif" alt="logo">
</header>

<nav>
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>

        <li>
            <a href="index.php?action=about">About Us</a>
        </li>

        <li>
            <a href="index.php?action=list" class="current_page">DVD ratings</a>
        </li>

        <li>
            <a href="index.php?action=contact">Contact Us</a>
        </li>

        <li>
            <a href="index.php?action=sitemap">Site Map</a>
        </li>
    </ul>
</nav>

<!-- start table for displaying DVD details -->
<h2>Lists of DVDs and their average votes</h2>

<table>
    <tr>
        <th> ID </th>
        <th> title </th>
        <th> category </th>
        <th> price </th>
        <th> vote average </th>
        <th> num votes </th>
        <th> stars </th>
    </tr>

    <!-- ********************* HTML for dvd items ****************** -->
<!--
    //   	0 - 15 - 40 - 55 - 70 - 85 - 100 %age
    // 	      .5   1    2    3    4    5     stars
-->
    <tr>
        <td>1</td>
        <td>Jaws</td>
        <td>thriller</td>
        <td>&euro; 10.00</td>
        <td>5 %</td>
        <td>1</td>
        <td><img src="images/starsHalf.png" alt="half star"></td>
    </tr>

    <tr>
        <td>2</td>
        <td>Jaws II</td>
        <td>thriller</td>
        <td>&euro; 5.99</td>
        <td>90 %</td>
        <td>77</td>
        <td><img src="images/stars5.png" alt="5 star"></td>
    </tr>

    <tr>
        <td>3</td>
        <td>Shrek</td>
        <td>comedy</td>
        <td>&euro; 10.00</td>
        <td>50 %</td>
        <td>5</td>
        <td><img src="images/stars3.png" alt="3 star"></td>
    </tr>

    <tr>
        <td>4</td>
        <td>Shrek II</td>
        <td>comedy</td>
        <td>&euro; 4.99</td>
        <td>0 %</td>
        <td>0</td>
        <td>(no votes yet)</td>
    </tr>

    <tr>
        <td>5</td>
        <td>Alien</td>
        <td>scifi</td>
        <td>&euro; 19.99</td>
        <td>95 %</td>
        <td>201</td>
        <td><img src="images/stars5.png" alt="5 star"></td>
    </tr>
</table>

<footer>
    2016 &copy; A Matt Smith productions interntional enterprises limited production
</footer>

</body>
</html>