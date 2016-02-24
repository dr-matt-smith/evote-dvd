<?php
namespace Itb;

class MessageRepository
{
    public function getAll()
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('SELECT * from messages');
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\Message');
        $statement->execute();

        $dvds = $statement->fetchAll();

        return $dvds;
    }

    public function getOneById($id)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $statement = $connection->prepare('SELECT * from messages WHERE id=:id');
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->setFetchMode(\PDO::FETCH_CLASS, '\\Itb\\Message');
        $statement->execute();

        if ($dvd = $statement->fetch()) {
            return $dvd;
        } else {
            return null;
        }
    }

    /**
     * insert new record into the DB table 'messages'
     * returns new record ID if insertation was successful, otherwise -1
     * @param Message $message
     * @return integer
     */
    public function create(Message $message)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $objectAsArrayForSqlInsert = $db->objectToArrayLessId($message);

        $statement = $connection->prepare('INSERT into messages (text, user, timestamp) value (:text, :user, :timestamp)');
        $statement->execute($objectAsArrayForSqlInsert);

        $queryWasSuccessful = ($statement->rowCount() > 0);
        if($queryWasSuccessful) {
            return $connection->lastInsertId();
        } else {
            return -1;
        }
    }

}
