<?php

namespace Pheuture\PdfEditTool\Helpers;

use PDO;
use PDOException;
use Pheuture\PdfEditTool\Contracts\ReadDataContract;

class ReadDataFromDB implements ReadDataContract {

    private object $dbConnection;

    public function __construct(
        private string $dbHost,
        private string $dbUserName,
        private string $dbPassword,
        private string $dbName,
        private string $tableName
    ){}

    public function connectWithDB(): bool {
        try {
            $this->dbConnection = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUserName, $this->dbPassword);
            // set the PDO error mode to exception
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

    public function getContent(): mixed
    {
        
        return null;
    }
}