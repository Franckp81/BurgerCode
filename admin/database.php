<?php

class Database{

    private static $dbHost = "localhost"; // Rend les variables privée pour seulement la class Database
    private static $dbName = "burger_code";
    private static $dbUser = "root";
    private static $dbUserPassword = "";

    private static $connection = null; // Me permet d'initialiser la variable pour la rendre accessible dans tout le fichier.

    
    public static function connect(){ // Me permet de stocker et retourner ma variable connection pour m'en servir plus tard avec par exemple prepare et execute.

        try {
        self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbUserPassword);
        // self:: me permet d'accedder à mes variables privées plus haut.    
        }
        catch (PDOException $e) {
        die($e->getMessage());
        }
        return self::$connection;
    }

    public static function disconnect(){
        self::$connection = null;
    }
}

Database::connect();



