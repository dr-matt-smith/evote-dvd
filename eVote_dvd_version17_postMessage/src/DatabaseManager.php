<?php
/**
 * Created by PhpStorm.
 * User: mattsmithdev
 * Date: 18/02/2016
 * Time: 11:58
 *
 * based on PDO tutorial at URL:
 * http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/
 */

namespace Itb;

/**
 * Class DatabaseManager - make things easy to work with MySQL DBs and PDO
 * @package Itb
 */
class DatabaseManager
{
    /**
     * get host name from config constant
     * @var string
     */
    private $host = DB_HOST;

    /**
     * get DB username from config constant
     * @var string
     */
    private $user = DB_USER;

    /**
     * get DB password from config constant
     * @var string
     */
    private $pass = DB_PASS;

    /**
     * get DB name from config constant
     * @var string
     */
    private $dbname = DB_NAME;

    /**
     * the DataBase Handler is our db connection object
     * @var database handler
     */
    private $dbh;

    /**
     * any error generated
     * @var string
     */
    private $error;

    public function __construct()
    {
        // DSN - the Data Source Name - requred by the PDO to connect
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        try {
            // Set options
            $options = array(
                \PDO::ATTR_PERSISTENT => true,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            );
            $this->dbh = new \PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            print 'sorry - a database error occured - please contact the site administrator ...';
            print '<br>';
            print  $e->getMessage();
        }
    }

    public function getDbh()
    {
        return $this->dbh;
    }

    /**
     * convert an Object into an associate array, and remove the first element (the 'id')
     * e.g. convert from this:
     *  Itb\Message Object
     *  (
     *      [id:Itb\Message:private] => (null or whatever)
     *      [text:Itb\Message:private] => hello there
     *      [user:Itb\Message:private] => matt
     *      [timestamp:Itb\Message:private] => 1456340266
     *  )
     *
     * to this:
     * Array
     * (
     *      [text] => hello there
     *      [user] => matt
     *      [timestamp] => 1456341484
     * )
     *
     * this is a convenient way to INSERT objects into autoincrement tables (so we don't want to pass the ID value - we want the DB to choose a new ID for us...)
     *
     * @param $object
     *
     * @return array
     */
    public function objectToArrayLessId($object)
    {
        // convert object into associative array
        $objectAsArray = (array)$object;

        $objectsAsArrayLessNamespaces = $this->removeNamespacesFromKeys($objectAsArray, $object);

        // remove the 'id' element
        unset($objectsAsArrayLessNamespaces['id']);

        // return this array
        return $objectsAsArrayLessNamespaces;
    }


    /**
     *
     * Given an associative array of key=>value pairs, where each key is in the form '\0Namespace\Class\0property'
     * (and an object from which the array was generated)
     * output the array, but with only the property names as the array keys
     * i.e remove the 'Namespace\Class' prefix from each element's array key
     *
     * note we use FILTER_SANITISE_STRING to remove the \0 characters
     *
     * e.g. convert from this:
     * Array
     * (
     *      [\0Itb\Message\0text] => hello there
     *      [\0Itb\Message\0user] => matt
     *      [\0Itb\Message\0timestamp] => 1456340361
     * )
     *
     * to this:
     * Array
     * (
     *      [text] => hello there
     *      [user] => matt
     *      [timestamp] => 1456341484
     * )
     *
     * @param array $properties array of properties (where keys are prefixed with namespace and class)
     * @param Object $object reference to object from which property array originated
     *
     * @return array
     */
    private function removeNamespacesFromKeys($properties, $object)
    {
        // get the class name, e.g. 'Itb\Message'
        $className = get_class($object);

        // empty array for new values
        $propertiesWithSimpleKeys = [];
        foreach($properties as $key=>$value){
            $simpleKey = str_replace($className, '', $key);
            $simpleKey = filter_var($simpleKey, FILTER_SANITIZE_STRING);
            $propertiesWithSimpleKeys[$simpleKey] = $value;
        }

        return $propertiesWithSimpleKeys;
    }

}