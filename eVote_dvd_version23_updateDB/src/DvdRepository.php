<?php
namespace Itb;

class DvdRepository extends DatabaseTableRepository
{
    public function __construct()
    {
        parent::__construct('Dvd', 'dvds');
    }

    public function searchByTitleOrCategory($searchText)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        // wrap wildcard '%' around the serach text for the SQL query
        $searchText = '%' . $searchText . '%';

        $statement = $connection->prepare('SELECT * from dvds WHERE (title LIKE :searchText) or (category LIKE :searchText)');
        $statement->bindParam(':searchText', $searchText, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\Dvd');
        $statement->execute();

        $dvds = $statement->fetchAll();

        return $dvds;
    }




}