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
    }
 ?>
