<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__ . '/../src/Items.php';
require __DIR__.'/../connection.php';
require __DIR__.'/../config.php';

class testItems extends PHPUnit_Extensions_Database_TestCase
{

    protected function getConnection()
    {
        // TODO: Implement getConnection() method.
        $conn = new PDO(
            $GLOBALS['DB_DSN'],
            $GLOBALS['DB_USER'],
            $GLOBALS['DB_PASSWD']
        );

        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection(
            $conn,
            $GLOBALS['DB_NAME']
        );
    }

    protected function getDataSet()
    {
        // TODO: Implement getDataSet() method.
        return $this->createXMLDataSet(__DIR__ . "/../fixtures/Items.xml");
    }

    public function testAddItem(){
        $startCount = count(Items::loadAllItems());
        $item = new Items("pralka", 2000, "cudownie pierze", 3, 1);
        $item->saveToDB($conn);
        $endCount = count(Items::loadAllItems());
        $this->assertEquals($startCount+1, $endCount);

    }




}