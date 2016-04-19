eVote_dvd - toString example
===========================

the __toString() magic method
-------------------------------------------------------
If a class declares a method __toString(), then this method will be invoked when
an object reference appears in an expression where a string is required, e.g.:

    $dvd = new Dvd();
    print $dvd; // __toString() method will be invoked...

So let's explore creating a __toString() method to output HTML for a table row.

NOTE - this is just to illustrate __toString() - not best practice
-------------------------------------------------------
don't actually use this HTML output as a way to implement your 'views' (HTML outputs),
since such an approach would 'couple' our Dvd class with the desired HTML table row 'view'.

But since we have Dvds and HTMl rows it makes for an easy example to write your first __toString() magic method.

Step 1 - add method __toString() in Dvd.php
-------------------------------------------------------
here is the code:


    /**
     * output (as a string) the values of this object
     * formatted as an HTML table
     *
     * note: PHP_EOL adds line breaks - so the HTML source code is easier for humans to read
     * (but it does add to the SIZE of the HTML text file - so readability vs. size tradeoff ...)
     *
     * @return string
     */
    public function __toString()
    {
        $htmlString = '';
        $htmlString .= PHP_EOL . PHP_EOL . '<tr>';
        $htmlString .= PHP_EOL . '<td>' . $this->id . '</td>';
        $htmlString .= PHP_EOL . '<td>' . $this->title . '</td>';
        $htmlString .= PHP_EOL . '<td>' . $this->category . '</td>';
        $htmlString .= PHP_EOL . '<td>&euro; ' . $this->price . '</td>';
        $htmlString .= PHP_EOL . '<td>' . $this->voteAverage . ' %</td>';
        $htmlString .= PHP_EOL . '<td>' . $this->numVotes . '</td>';
        $htmlString .= PHP_EOL . '<td>' . $this->getStarImageHTML() . '</td>';
        $htmlString .= PHP_EOL . '</tr>';

        return $htmlString;
    }


Step 2 - simplify our list.php template to just 'print' each Dvd object
-------------------------------------------------------
here is the simple look inside ```list.php```:

    <?php
        foreach($dvds as $dvd) {
            print $dvd;
        }
    ?>

Since the 'print' statement expects to receive a string, then the __toString() method of the $dvd object is invoked.


Author
-------------------------------------------------------

Dr Matt Smith,
www.mattsmithdev.com

Senior Lecturer in Computing
Institute of Technology Blanchardstown
Dublin, Ireland
www.itb.ie
