<?php
namespace App\Core;

class Database {

    protected static $instance;

    public static function getInstance() {
        if(empty(self::$instance)) {
            $db_info = array(
                "db_host" => "localhost",
                "db_port" => "3306",
                "db_user" => "root",
                "db_pass" => "",
                "db_name" => "grades_manager"
            );
            try {
                self::$instance = new \PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
                self::$instance->query('SET NAMES utf8mb4');
                self::$instance->query('SET CHARACTER SET utf8mb4');
            } catch(\PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance;
    }
}
?>