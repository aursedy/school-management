<?php 
define("HOST", "localhost");
define("NAME", "school_db");
define("USER", "root");
define("PASSWORD", "root");

class DBConnection{

    static private $instance = NULL;

    public static function getPDO(): PDO
    {

        if (self::$instance == NULL) {
            $conn = new PDO("mysql:host=" . HOST . ";dbname=" .NAME  . "", USER, PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance = $conn;
        }
        return self::$instance;
    }
}
?>