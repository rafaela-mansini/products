<?php
class Database
{
    const HOST = 'localhost';
    const DATABASE = 'store';
    const USER = 'rafaela';
    const PASSWORD = '123456789';

    public static $connection;

    public static function getConnection()
    {
        $dsn = 'mysql://host='.self::HOST.';dbname='.self::DATABASE.';charset=utf8';
        try {
            self::$connection = new PDO($dsn, self::USER, self::PASSWORD);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$connection;
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
}