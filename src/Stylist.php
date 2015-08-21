<?php
    class Stylist
    {
        private $stylist_name;
        private $id;

        function __construct($stylist_name, $id = null)
        {
            $this->stylist_name = $stylist_name;
            $this->id = $id;
        }
        function setStylistName($new_stylist_name)
        {
            $this->stylist_name = (string) $new_stylist_name;
        }
        function getStylistName()
        {
            return $this->stylist_name;
        }
        function getId()
        {
            return $this->id;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylist (stylist_name) VALUES
            ('{$this->getStylistName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        static function getAll()
        {
            $returned_stylist = $GLOBALS['DB']->query("SELECT * FROM stylist;");
            $stylists = array();
            foreach($returned_stylist as $stylist) {
                $stylist_name = $stylist['stylist_name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($stylist_name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylist;");
        }
    }
 ?>
