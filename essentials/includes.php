<?php
/**
 * Created by PhpStorm.
 * User: session2
 * Date: 9/27/16
 * Time: 4:24 PM
 */

class Database{
    private $host = 'localhost';
    private $pass = 'root';
    private $user = 'root';
    private $dbname = 'myblog';

    private $dbh;
    private $error;
    private $stmt;

    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host='. $this->host . ';dbname='. $this->dbname;
        // Set Options
        $options = array(
            PDO::ATTR_PERSISTENT		=> true,
            PDO::ATTR_ERRMODE		=> PDO::ERRMODE_EXCEPTION
        );
        // Create new PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query){

        $this->stmt = $this->dbh->prepare($query);

    }

    public function

}