<?php

try {

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        './App/Controllers/',
        './App/Models/'
    ))->register();

    //Create a DI
    $di = new Phalcon\DI\FactoryDefault();
	
	 //Setup the database service
    $di->set('db', function(){
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "182.92.6.96",
            "username" => "root",
            "password" => "123456",
            "dbname" => "vote"
        ));
    });

    //Setting up the view component
    $di->set('view', function(){
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir('./App/Views/');
        return $view;
    });
   $di->set('url', function(){
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/phalcon/');
		$url->setBaseUri('/');
        return $url;
    });
    //Handle the request
    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);
    echo $application->handle()->getContent();

} catch(\Phalcon\Exception $e) {
     echo "PhalconException: ", $e->getMessage();
}
