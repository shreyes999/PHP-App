<?php

namespace Core;

use PDO;

class Database
{
    public $connections;
    public function __construct($config)
    {

        $dsn = "mysql:" . http_build_query($config, '', ';');

        $this->connections = new PDO($dsn, 'best', 'aszx', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $param = [])
    {
        $statement = $this->connections->prepare($query);
        $statement->execute($param);

        return $statement;
    }
}
