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
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Robin";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getClientName();

            //Assert
            $this->assertEquals($client_name, $result);
        }
        function test_getStylistId()
        {
            //Arrange
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Robin";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = $test_client->getStylistId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        function test_getId()
        {
            //Arrange
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Robin";
            $id = 1;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id, $id);

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        function test_save()
        {
            //Arrange
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Robin";
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);
        }
        function test_getAll()
        {
            //Arrange
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Robin";
            $client_name2 = "Darla";
            $stylist_id = $test_stylist->getId();


            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Robin";
            $client_name2 = "Darla";
            $stylist_id = $test_stylist->getId();


            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $test_client2 = new Client($client_name2, $stylist_id);
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
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $client_name = "Robin";
            $client_name2 = "Darla";
            $stylist_id = $test_stylist->getId();


            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }
    }


 ?>
