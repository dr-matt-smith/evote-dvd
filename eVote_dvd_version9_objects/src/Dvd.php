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
     * @var string
     */
    private $imageFile;

    /**
     * @var string
     */
    private $altText;

    /**
     * Dvd constructor.
     * @param $id
     */
    public function __construct($id, $title, $category, $price, $voteAverage, $numVotes, $imageFile, $altText)
    {
        $this->id = $id;
        $this->title = $title;
        $this->category = $category;
        $this->price = $price;
        $this->voteAverage = $voteAverage;
        $this->numVotes = $numVotes;
        $this->imageFile = $imageFile;
        $this->altText = $altText;
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

}