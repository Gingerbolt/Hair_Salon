<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
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
        $new_stylist->save();
        return $app['twig']->render('home.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/{id}/delete", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });
    $app->get("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('clients.html.twig', array('clients' => $stylist->getClients(), 'stylist' => $stylist));
    });
    $app->post("/stylist/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $new_client_name = $_POST['name'];
        $new_client_stylist_id = $_POST['stylist_id'];
        $new_client = new Client($new_client_name, $new_client_stylist_id);
        $new_client->save();
        return $app['twig']->render('clients.html.twig', array('clients' => $stylist->getClients(), 'stylist' => $stylist));
    });
    $app->post("/stylist/{id}/edit", function($id) use ($app) {
      $client_id = $_POST['client_id'];
      $client_name_edit = $_POST['name_edit'];
      $client = Client::find($client_id);
      $client->updateName($client_name_edit);
      $stylist = Stylist::find($id);
      return $app['twig']->render('clientelle_edit.html.twig', array('client' => $client, 'stylist' => $stylist));
    });
    $app->post("/stylist/{id}/delete", function($id) use ($app) {
      $client_id = $_POST['client_id'];
      $client = Client::find($client_id);
      $client->delete();
      $stylist = Stylist::find($id);
      return $app['twig']->render('clientelle_edit.html.twig', array('client' => $client, 'stylist' => $stylist));
    });

    return $app;
?>
