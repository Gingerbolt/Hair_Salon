<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    // require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Client::deleteAll();
        // }
        function testGetName()
        {
            $name = "Jose";
            $stylist_match_id = 5;
            $test_client = new Client($name, $stylist_match_id);

            $result = $test_client->getName();

            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            $name = "Josefina";
            $stylist_match_id = 3;
            $test_client = new Client($name, $stylist_match_id);
            $new_name = "Alex";

            $test_client->setName($new_name);
            $result = $test_client->getName();

            $this->assertEquals($new_name, $result);
        }
    }
?>
