<?php

/**
 * Created by PhpStorm.
 * User: matt
 * Date: 26/01/2016
 * Time: 10:44
 *
 * represent DVD objects for use in voting system
 *
 *
<th> ID </th>
<th> title </th>
<th> category </th>
<th> price </th>
<th> vote average </th>
<th> num votes </th>
<th> stars </th>
 *
 */
class Dvd
{
    /**
     * the objects unique ID
     * @var int
     */
    private $id;

    /**
     * @var string $title
     */
    private $title;

    /**
     * (should become ID of separate CATEGORY class ...)
     * @var string $category
     */
    private $category;

    /**
     * @var float
     */
    private $price;

    /**
     * integer value from 0 .. 100
     * @var integer
     */
    private $voteAverage;

    /**
     * @var integer
     */
    private $numVotes;

    /**
     * Dvd constructor.
     * @param $id
     */
    public function __construct($id, $title, $category, $price, $voteAverage, $numVotes)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->price = $price;
        $this->voteAverage = $voteAverage;
        $this->numVotes = $numVotes;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    public function getNumVotes()
    {
        return $this->numVotes;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getAltText()
    {
        return $this->altText;
    }

    /**
     * function will exit with first return
     * so conditions ordered strongest test first, down to weakest test ...
     *
     * @return string
     */
    public function getStarimageHTML()
    {
        if ($this->numVotes < 1){
            return '(no votes yet)';
        }

        if ($this->voteAverage > 80){
            return  '<img src="images/stars5.png" alt="five starts star">';
        }

        if ($this->voteAverage > 60){
            return  '<img src="images/stars4.png" alt="four star">';
        }

        if ($this->voteAverage > 45){
            return  '<img src="images/stars3.png" alt="three star">';
        }

        if ($this->voteAverage > 25){
            return  '<img src="images/stars2.png" alt="two star">';
        }

        if ($this->voteAverage > 10){
            return  '<img src="images/stars1.png" alt="one star">';
        }

        // if get here, just give half a star
        return  '<img src="images/starsHalf.png" alt="half star">';

    }

}