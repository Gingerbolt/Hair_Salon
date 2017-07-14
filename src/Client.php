<?php
    class Client
    {
        private $name;
        private $stylist_match_id;
        private $id;

        function __contstruct($name, $id = null)
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

        function save()
        {

        }

        function getAll()
        {

        }

        function deleteAll()
        {

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
