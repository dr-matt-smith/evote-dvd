<?php
namespace Itb;

class DvdRepository
{
    private $dvds = [];
    
    public function __construct()
    {
        $this->dvds = [];
        $this->dvds[] = new Dvd(1, 'Jaws', 'thriller', 10.00, 5, 1);
        $this->dvds[] = new Dvd(2, 'Jaws II', 'thriller', 5.99, 90, 77);
        $this->dvds[] = new Dvd(3, 'Shrek', 'comedy', 10.00, 50, 5);
        $this->dvds[] = new Dvd(4, 'Shrek II', 'comedy', 4.99, 0, 0);
        $this->dvds[] = new Dvd(5, 'Alien', 'scifi', 19.00, 95, 201);
    }

    public function getAll()
    {
        return $this->dvds;
    }
}