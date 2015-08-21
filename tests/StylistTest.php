<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
       {
           Stylist::deleteAll();
        //    Client::deleteAll();
       }

        function test_getStylistName()
        {
            //Arrange
            $stylist_name = "Donna";
            $test_stylist = new Stylist($stylist_name);

            //Act
            $result = $test_stylist->getStylistName();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }
        function test_getId()
        {
            //Arrange
            $stylist_name = "Donna";
            $id = 1;
            $test_stylist = new Stylist($stylist_name, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

        }
        function test_save()
        {
            //Arrange
            $stylist_name = "Donna";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist, $result[0]);
        }
        function test_getAll()
        {
            //Arrange
            $stylist_name = "Donna";
            $stylist_name2 = "Ronda";

            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $test_stylist2 = new Stylist($stylist_name);
            $test_stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $stylist_name = "Donna";
            $stylist_name2 = "Ronda";

            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $test_stylist2 = new Stylist($stylist_name);
            $test_stylist->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);

        }
        function test_find()
        {
            //Arrange
            $stylist_name = "Donna";
            $stylist_name2 = "Ronda";

            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();

            $test_stylist2 = new Stylist($stylist_name);
            $test_stylist->save();

            //Act
            $result = Stylist::find($test_stylist->getId());

            //Assert
            $this->assertEquals($test_stylist, $result);

        }
        function test_getAllClients()
        {
            //Arrange
            $stylist_name = "Donna";
            $id = null;
            $test_stylist = new Stylist($stylist_name, $id);
            $test_stylist->save();

            $test_stylist_name_id = $test_stylist->getId();

            $client_name = "Robin";
            $client_id = $test_stylist->getId();
            $stylist_id = $test_stylist->getId();


            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            $client_name2 = "Darla";
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = $test_stylist->getAllClients();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }
    }

?>
