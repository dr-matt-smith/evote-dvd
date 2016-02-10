<?php
namespace Itb;

class DvdRepository
{
    private $dvds = [];
    
    public function __construct()
    {
        $this->dvds = [];
        $this->dvds[] = new Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1, 'starsHalf.png', 'half star');
        $this->dvds[] = new Dvd(2, 'Jaws II', 'thriller', 5.99, 90, 77, 'stars5.png', '5 star');
        $this->dvds[] = new Dvd(3, 'Shrek', 'comedy', 10.00, 50, 5, 'stars3.png', '3 star');
        $this->dvds[] = new Dvd(4, 'Shrek II', 'comedy', 4.99, 0, 0, '', '');
        $this->dvds[] = new Dvd(5, 'Alien', 'scifi', 19.00, 95, 201, 'stars5.png', '5 star');       
    }

    public function getAll()
    {
        return $this->dvds;
    }
}