<?php

    use UNLCE\Router\Router;
    use UNLCE\Controller\Controller;
    use UNLCE\Model\Model;

    require __DIR__ . '/app/classes/Router.php';
    require __DIR__ . '/app/classes/Controller.php';
    require __DIR__ . '/app/classes/Model.php';

    Router::run('/user/:id', 'Users@index');
    Router::run('/', 'Home@index');
    Router::error(function () {
        $controller = new Controller;
        $controller -> view('404');
    });

?>