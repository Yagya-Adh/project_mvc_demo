<?php

namespace App\Models;

abstract class Db
{
    const SERVER_NAME = 'db';
    const DB_USER = 'root';
    const PASSWORD = 'secret';
    const DB_NAME = 'app';

    public $dbConnection;

    protected $tableName;

    protected function test()
    {
    }


    /**
     * @throws \Exception
     */
    public function __construct()
    {
        if (empty($this->tableName)) {
            throw new \Exception("Table name not defined");
        }
        $this->connect();
    }

    private function connect()
    {

        $this->dbConnection = new \PDO(
            'mysql:host=' . self::SERVER_NAME . ';dbname=' . self::DB_NAME,
            self::DB_USER,
            self::PASSWORD
        );
        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function findAll()
    {
        $query = "SELECT * FROM ".$this->tableName.";";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}