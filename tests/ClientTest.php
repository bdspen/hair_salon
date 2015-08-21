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
        protected function tearDown()
        {
            Client::deleteAll();
        }
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
        function test_save()
        {
            //Arrange
            $client_name = "Robin";
            $test_client = new Client($client_name);
            $test_client->save();

            //Act
            $result = client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);
        }
        function test_getAll()
        {
            //Arrange
            $client_name = "Robin";
            $client_name2 = "Darla";

            $test_client = new Client($client_name);
            $test_client->save();

            $test_client2 = new Client($client_name);
            $test_client2->save();

            //Act
            $result = client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $client_name = "Robin";
            $client_name2 = "Darla";

            $test_client = new Client($client_name);
            $test_client->save();

            $test_client2 = new Client($client_name);
            $test_client->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);

        }
        function test_find()
        {
            //Arrange
            $client_name = "Donna";
            $client_name2 = "Ronda";

            $test_client = new Client($client_name);
            $test_client->save();

            $test_client2 = new Client($client_name);
            $test_client->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }
    }


 ?>
