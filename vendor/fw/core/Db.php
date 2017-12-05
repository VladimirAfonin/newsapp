<?php

namespace fw\core;


use R;
use fw\core\traits\TSingleton;


class Db
{
    use TSingleton;

    public $pdo;
//    protected static $instance;
    public static $countSql = 0;
    public static $queries = [];


    private function __construct()
    {
        $db = require_once ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config_db.php';
        require_once LIBS . DIRECTORY_SEPARATOR . 'rb.php';

        /*
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        */

        // connection to Db.
        R::setup($db['dsn'], $db['user'], $db['pass']);

        // freeze structure of the tables.
        R::freeze(TRUE);

        // enable debug.
//        R::fancyDebug(TRUE);
//        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

//    /**
//     * get instance of Db.
//     *
//     * @return Db
//     */
//    public static function getInstance()
//    {
//        if(self::$instance === NULL) {
//            self::$instance = new self;
//        }
//        return self::$instance;
//    }

    /**
     * execute sql query.
     *
     * @param $sql
     * @param array $params
     * @return bool
     */
//    public function execute($sql, $params = [])
//    {
//        self::$countSql++;
//        self::$queries[] = $sql;
//        $stmt = $this->pdo->prepare($sql);
//        return $stmt->execute($params);
//    }

    /**
     * return result of sql query.
     *
     * @param $sql
     * @param array $params
     * @return array
     */
//    public function query($sql, $params = [])
//    {
//        self::$countSql++;
//        self::$queries[] = $sql;
//        $stmt = $this->pdo->prepare($sql);
//        $res = $stmt->execute($params);
//        if($res !== FALSE) {
//            return $stmt->fetchAll();
//        }
//        return [];
//    }





}