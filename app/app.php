<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    //Homepage route
    $app->get("/", function() use ($app) {
        return $app['twig']->render ('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    //Add a stylist on the homepage
    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['stylist_name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    //View a particular stylist's page and their list of clients with getAllClients() method
    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig',
        array('stylist' => $stylist, 'clients' => $stylist->getAllClients()));
    });

    //save a new client
    $app->post("/clients", function() use ($app) {
        $client_name = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($client_name, $stylist_id);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array('stylists' => $stylist,
        'clients' => $stylist->getAllClients(), 'stylist' => $stylist));
    });

    // Clear ALL Stylists
    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    //DELETE ALL CLIENTS
    $app->post("/delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    //DELETE INDIVIDUAL STYLISTS
    $app->delete("/stylist/{id}/delete", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    //EDIT STYLIST PAGE
    $app->get("/stylist/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array(
        'stylist' => $stylist));
    });
    //EDIT CLIENT PAGE
    $app->get("/client/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array(
        'client' => $client));
    });
    //DELETE CLIENT
    $app->delete("/client/{id}/delete", function($id) use ($app) {
        $client = Client::find($id);
        $client->delete();
        $stylist_id = $client->getStylistId();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('stylist.html.twig', array(
        'clients' => $stylist->getAllClients(),
        'stylist' => $stylist));
    });
    //UPDATE CLIENT
        $app->patch("/client/{id}", function($id) use ($app) {
        $new_client_name = $_POST['name'];
        $client = Client::find($id);
        $client->updateName($new_client_name);
        $stylist = Stylist::find($client->getStylistId());
        return $app['twig']->render('stylist.html.twig', array(
        'stylists' => Stylist::getAll(), 'stylist' => $stylist,
        'clients' => $stylist->getAllClients()));
    });
    //UPDATE Stylist
        $app->patch("/stylist/{id}", function($id) use ($app) {
        $new_stylist_name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->updateName($new_stylist_name);
        return $app['twig']->render('stylist.html.twig', array(
        'stylist' => $stylist, 'clients' => $stylist->getAllClients()));
    });


    return $app;
 ?>
