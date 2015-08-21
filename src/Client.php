<?php
    class Client
    {
        private $client_name;
        private $id;

        function __construct($client_name, $id = null)
        {
            $this->client_name = $client_name;
            $this->id = $id;
        }
        function setClientName($new_client_name)
        {
            $this->client_name = (string) $new_client_name;
        }
        function getClientName()
        {
            return $this->client_name;
        }
        function getId()
        {
            return $this->id;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO client (client_name) VALUES
            ('{$this->getClientName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client;");
            $clients = array();
            foreach($returned_clients as $client) {
                $client_name = $client['client_name'];
                $id = $client['id'];
                $new_client = new Client($client_name, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM client;");
        }
    }
 ?>
