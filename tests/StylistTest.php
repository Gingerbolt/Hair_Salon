<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {

            $name = "Jeanine";
            $test_stylist = new Stylist($name);

            $result = $test_stylist->getName();
            var_dump($test_stylist->getName());

            $this->assertEquals($name, $result);
        }
    }

?>