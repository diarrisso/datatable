<?php

class dbConfig
{
    protected $serverName;
    protected $userName;
    protected $password;
    protected $dbName;

    public function __construct()
    {
        $this->serverName = 'localhost:3306';
        $this->userName = 'root';
        $this->password = "root";
        $this->dbName = "Blog";
    }
}
