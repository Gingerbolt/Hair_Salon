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
        protected function tearDown()
        {
            Stylist::deleteAll();
        }
        function testGetName()
        {
            $name = "Jeanine";
            $test_stylist = new Stylist($name);

            $result = $test_stylist->getName();

            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            $name = "Jeanine";
            $test_stylist = new Stylist($name);
            $new_name = "Miranda";

            $test_stylist->setName($new_name);
            $result = $test_stylist->getName();

            $this->assertEquals($new_name, $result);
        }

        function testGetId()
        {
            $name = "Marcia";
            $id = 40;
            $test_stylist = new Stylist($name, $id);

            $result = $test_stylist->getId();

            $this->assertEquals($id, $result);
        }

        function testSave()
        {
            $name = "George";
            $test_stylist = new Stylist($name);

            $executed = $test_stylist->save();

            $this->assertTrue($executed, "Stylist not successfully saved to database");
        }

        function testGetAll()
        {
            $name = "Jessica";
            $name_2 = "Robert";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist_2 = new Stylist($name_2);
            $test_stylist_2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist, $test_stylist_2], $result);
        }

        function testDeleteAll()
        {

            $name = "Frank";
            $name_2 = "Shauna";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist_2 = new Stylist($name_2);
            $test_stylist_2->save();

            Stylist::deleteAll();
            $result = Stylist::getAll();

            $this->assertEquals([], $result);
        }

        function testFind()
        {
            $name = "Stella";
            $name2 = "Franco";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist_2 = new Stylist($name2);
            $test_stylist_2->save();

            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals($test_stylist, $result);
        }

        function testUpdateName()
        {
            $name = "Cassie";
            $test_stylist = new Stylist($name);
            $name_2 = "Castellan";
            $test_stylist->save();

            $test_stylist->updateName($name_2);

            $this->assertEquals($name_2, $test_stylist->getName());
        }

        function testDelete()
        {

            $name = "Ichiban";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $name_2 = "Niban";
            $test_stylist_2 = new Stylist($name_2);
            $test_stylist_2->save();

            $test_stylist->delete();

            $this->assertEquals([$test_stylist_2], Stylist::getAll());
        }

        function testGetClients()
        {

            $name = "Shanara";
            $test_stylist = new Stylist($name);
            $test_stylist->save();
            $test_stylist_id = $test_stylist->getId();
            $name_2 = "Talana";
            $test_client = new Client($name_2, $test_stylist_id);
            $test_client->save();
            $name_3 = "Einstein";
            $test_client_2 = new Client($name_3, $test_stylist_id);
            $test_client_2->save();

            $result = $test_stylist->getClients();

            $this->assertEquals([$test_client, $test_client_2], $result);
        }

    }

?>
