<?php
    class Client
    {
        private $name;
        private $stylist_match_id;
        private $id;

        function __construct($name, $stylist_match_id, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
            $this->stylist_match_id = $stylist_match_id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getStylistMatchId()
        {
            return $this->stylist_match_id;
        }

        function setStylistMatchId($stylist_match_id)
        {
            $this->stylist_match_id = $stylist_match_id;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_match_id) VALUES ('{$this->getName()}', '{$this->getStylistMatchId()}');");
            if ($executed) {
               $this->id= $GLOBALS['DB']->lastInsertId();
               return true;
            } else {
               return false;
            }
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $id = $client['id'];
                $stylist_match_id = $client['stylist_match_id'];
                $new_client = new Client($name, $stylist_match_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        function find()
        {

        }

        function update()
        {

        }

        function delete()
        {

        }
    }
?>
