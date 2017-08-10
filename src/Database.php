<?php

//  plik config/dbconfig.php w formacie:
//  {
//  "host":"localhost",
//  "database":"nazwa bazy danych",
//  "user":"nazwa uzytkownika",
//  "pass":"haslo bazy danych"
//  }

class Database
{

    public static $conn;

    public static function connect()
    {
        $config = json_decode(
            file_get_contents(__DIR__."/../config/dbconfig.php")
        );

        $dsn = "mysql:host=".$config->host.";dbname=".$config->database;

        self::$conn = new PDO($dsn,$config->user,$config->pass);
    }

    public static function getArray($object)
    {
        $array = get_object_vars($object);
        unset($array["id"]);
        return $array;
    }

    public static function renderQuery($object)
    {
        $array = self::getArray($object);
        $start = "INSERT INTO ".$object::table." (";
        $keys = implode(",",array_keys($array));
        $end = ") VALUES (".str_repeat("?,",count($array)-1)."?)";
        return $start.$keys.$end;
    }

    public static function save($object)
    {
        $sql = self::renderQuery($object);
        $stmt = self::$conn->prepare($sql);
        return $stmt->execute(array_values(
            self::getArray($object)
        ));


    }

    public static function selectByParameter($nameOfClass,$NameOfParameter,$parameter)
    {
        $sql = "SELECT * FROM ".$nameOfClass::table." WHERE ".
            $NameOfParameter." = :".$NameOfParameter;
        $stmt = Database::$conn->prepare($sql);
        $stmt->execute([$NameOfParameter => $parameter]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





    public static function selectAll($nameOfClass,$type = PDO::FETCH_ASSOC)
    {
        $sth = self::$conn->query("SELECT * FROM ".$nameOfClass::table);
        return $sth->fetchAll($type);
    }


}