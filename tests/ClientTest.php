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
        protected function tearDown()
        {
            Client::deleteAll();
        }
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

        function testGetStylistMatchId()
        {
            $name = "Lorell";
            $stylist_match_id = 7;
            $test_client = new Client($name, $stylist_match_id);

            $result = $test_client->getStylistMatchId();

            $this->assertEquals($stylist_match_id, $result);
        }

        function testSetStylistMatchId()
        {
            $name = "Terrence";
            $stylist_match_id = 8;
            $test_client = new Client($name, $stylist_match_id);
            $new_id = 9;

            $test_client->setStylistMatchId($new_id);
            $result = $test_client->getStylistMatchId();

            $this->assertEquals($new_id, $result);
        }

        function testGetId()
        {
          $name = "Mars";
          $stylist_match_id = 19;
          $id = 40;
          $test_client = new Client($name, $stylist_match_id, $id);

          $result = $test_client->getId();

          $this->assertEquals($id, $result);
        }

        function testSave()
        {
            $name = "Talos";
            $stylist_match_id = 18;
            $test_client = new Client($name, $stylist_match_id);

            $executed = $test_client->save();

            $this->assertTrue($executed, "Client not successfully saved to database");
        }

        function testGetAll()
        {
            $name = "Falchia";
            $stylist_match_id = 12;
            $name_2 = "Naomi";
            $stylist_match_id_2 = 21;
            $test_client = new Client($name, $stylist_match_id);
            $test_client->save();
            $test_client_2 = new Client($name_2, $stylist_match_id_2);
            $test_client_2->save();

            $result = Client::getAll();

            $this->assertEquals([$test_client, $test_client_2], $result);
        }

        function testDeleteAll()
        {

            $name = "Shandra";
            $stylist_match_id = 15;
            $name_2 = "Grunkla";
            $stylist_match_id_2 = 52;
            $test_client = new Client($name, $stylist_match_id);
            $test_client->save();
            $test_client_2 = new Client($name_2, $stylist_match_id_2);
            $test_client_2->save();

            Client::deleteAll();
            $result = Client::getAll();

            $this->assertEquals([], $result);
        }

        function testFind()
        {
            $name = "Arslan";
            $stylist_match_id = 24;
            $name2 = "Sam";
            $stylist_match_id_2 = 25;
            $test_client = new Client($name, $stylist_match_id);
            $test_client->save();
            $test_client_2 = new Client($name2, $stylist_match_id_2);
            $test_client_2->save();

            $result = Client::find($test_client->getId());

            $this->assertEquals($test_client, $result);
        }


    }
?>
