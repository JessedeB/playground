<?php

namespace App\Controller;

use PDO;

class Database {

    private $dbh;
    private $stmt;
    protected array $attributes = [];
    public array $items = [];

    public function __construct()
    {
        $params = [
          PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_PERSISTENT => true
        ];

        $dsn = 'mysql:host=localhost;dbname=testdb;';

        $this->dbh = new PDO(
            $dsn,
            'root',
            '',
            $params
        );

        return $this->dbh;
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {
        if(is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function all()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function asKey()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_UNIQUE);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowcount()
    {
        return $this->stmt->rowCount();
    }

    public function map(callable $callback)
    {
        $keys = array_keys($this->items);

        $items = array_map($callback, $this->items, $keys);

        return new static(array_combine($keys, $items));
    }

    public function mapWithKeys(callable $callback)
    {
        $result = [];

        foreach ($this->items as $key => $value) {
            $assoc = $callback($value, $key);

            foreach ($assoc as $mapKey => $mapValue) {
                $result[$mapKey] = $mapValue;
            }
        }

        return new static($result);
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->items)) {
            dump('true');
            return $this->items[$key];
        }

        dump('false');

        return value($default);
    }

}
