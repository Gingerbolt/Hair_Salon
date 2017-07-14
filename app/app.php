<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=bestaurants';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' =>__DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/", function() use ($app) {
        $new_name = $_POST['name'];
        $new_stylist = new Stylist($new_name);
        return $app['twig']->render('home.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('clients.html.twig', array('clients' => $stylist->getClients()));
    });
    $app->post("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $new_client_name = $_POST['name'];
        $new_client_stylist_id = $id;
        $new_client = new Client($new_client_name, $new_client_stylist_id);
        $new_client->save();
        return $app['twig']->render('clients.html.twig', array('clients' => $stylist->getClients()));
    });
    $app->post("/delete_stylists", function() use ($app) {
      Stylist::deleteAll();
      return $app['twig']->render('delete_stylists.html.twig');
    });
    $app->post("/delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('delete_clients.html.twig');
    });

    return $app;
?>
