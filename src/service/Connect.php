<?php

class Connect
{

    protected $pdo = null;

    public function __construct($database)
    {
        try {
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];
            $pdo = new PDO("mysql:host=" . $database['host'] . ";dbname=" . $database['dbname'], $database['username'], $database['password'], $options
            );

            $this->pdo = $pdo;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    /**
     * getDB
     * 
     * @return \PDO
     */
    public function getDB()
    {
        return $this->pdo;
    }

    /**
     * deconnect termine la connexion à la base de données
     * 
     * @return null
     */
    public function deconnect()
    {
        $this->pdo = null;
    }

}
