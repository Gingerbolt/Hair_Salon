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

        static function find($search_id)
        {
            $found_client = null;
            $returned_clients = $GLOBALS['DB']->prepare("SELECT * FROM clients WHERE id = :id;");
            $returned_clients->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_clients->execute();
            foreach($returned_clients as $client) {
                $client_name = $client['name'];
                $client_id = $client['id'];
                $client_stylist_match_id = $client['stylist_match_id'];
                if ($client_id == $search_id) {
                    $found_client = new Client($client_name, $client_stylist_match_id, $client_id);
                }
            }
            return $found_client;
        }

        function updateName($new_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            if ($executed) {
               $this->setName($new_name);
               return true;
            } else {
               return false;
            }
        }

        function updateStylistId()
        {

        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
             if (!$executed) {
                 return false;
             } else {
                 return true;
             }
        }
    }
?>
