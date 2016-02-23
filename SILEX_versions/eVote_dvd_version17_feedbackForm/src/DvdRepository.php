<?php
namespace Itb;

use Monolog\Logger;

class DvdRepository
{
    public function getAll()
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('SELECT * from dvds');
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\Dvd');
        $statement->execute();

        $dvds = $statement->fetchAll();

        return $dvds;
    }

    public function getOneById($id)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('SELECT * from dvds WHERE id=:id');
        $statement->bindParam(':id', $id);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\Dvd');
        $statement->execute();

        if ($dvd = $statement->fetch()) {
            return $dvd;
        } else {
            return null;
        }
    }


}