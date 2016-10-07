<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 06.10.16
 * Time: 11:57
 */

class Connection{                                                           //singletone connection
    /**
     * @var
     */
    protected static $_instance;
    /**
     * @var mysqli
     */
    public $db;

    /**
     * @return Connection
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    /**
     * Connection constructor.
     */
    private function __construct()
    {
        $this->db = $this->getConnection();
    }

    /**
     * @return mysqli
     */
    private function getConnection()
    {
        $servername = "localhost";
        $username = "pcstudio_amazon";
        $password = "JZEFAu9u92VPPmJY";
        $dbname = "mvc";

        $connection = new mysqli($servername, $username, $password, $dbname);

        if ($connection->connect_error) {
            die("DB Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }
}