<?php
namespace Itb;

class Message
{
    /**
     * the object's unique ID
     * @var int
     */
    private $id;

    /**
     * @var string $text
     */
    private $text;

    /**
     * name of person who posted the text
     * @var string $user
     */
    private $user;

    /**
     * PHP timestamp of when text created
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * get the timestamp as a PHP \DateTime object
     * @return \DateTime
     */
    public function getTimestamp()
    {
        $dateTimeObject = new \DateTime();
        $dateTimeObject->setTimestamp($this->timestamp);

        return $dateTimeObject;
    }

}