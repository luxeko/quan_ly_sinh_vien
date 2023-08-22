<?php
class Connection
{
    private const SERVERNAME = "localhost:3306";
    private const USERNAME = "root";
    private const PASSWORD = "";
    private const DATABASENAME = "quan_ly_sinh_vien";

    public static function getConnection()
    {
        $connection = new mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DATABASENAME);
        if ($connection->connect_error) {
            die('Kết nối không thành công ' . $connection->connect_error);
        }
        return $connection;
    }
    public static function closeConnection($connection)
    {
        if ($connection != null) {
            $connection->close();
        }
    }
}
