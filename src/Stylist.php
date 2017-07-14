<?php
    class Stylist
    {
        private $name;
        private $id;

        function __contstruct($name, $id = null)
        {
            $this->name = (string) $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
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
