<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        function test_getClientName()
        {
            //Arrange
            $client_name = "Robin";
            $test_client = new Client($client_name);

            //Act
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals($client_name, $result);
        }
        function test_getId()
        {
            //Arrange
            $client_name = "Robin";
            $id = 1;
            $test_client = new Client($client_name, $id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
    }


 ?>
