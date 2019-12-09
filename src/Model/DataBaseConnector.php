<?php

namespace src\Model;

/**
 * Class DataBaseConnector
 * @package src\Model
 */
class DataBaseConnector extends \MySQLi
{

    private static $instance = null ;

    private function __construct($host, $user, $password, $database){
        parent::__construct($host, $user, $password, $database);
    }

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new self(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            self::$instance->set_charset("utf8");
        }
        return self::$instance ;
    }
}

