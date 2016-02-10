<?php
require_once __DIR__ . '/../templates/header.inc.php';
require_once __DIR__ . '/../templates/nav.inc.php';

//-------------------------------------------
?>

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


<?php
    foreach($dvds as $dvd) {
        ?>

        <tr>
            <td><?= $dvd['id'] ?></td>
            <td><?= $dvd['title'] ?></td>
            <td><?= $dvd['category'] ?></td>
            <td>&euro; <?= $dvd['price'] ?></td>
            <td><?= $dvd['voteAverage'] ?> %</td>
            <td><?= $dvd['numVotes'] ?></td>
            <?php
            if ($dvd['numVotes'] > 0) {
                print '<td><img src="images/' . $dvd['imageFile'] . '" alt="' . $dvd['altText'] . '"></td>';
            } else {
                print '<td>(no votes yet)</td>';
            }
            ?>
        </tr>

        <?php
    }
?>


</table>

<?php
//-------------------------------------------
require_once __DIR__ . '/../templates/footer.inc.php';

//  don't close the PHP tags