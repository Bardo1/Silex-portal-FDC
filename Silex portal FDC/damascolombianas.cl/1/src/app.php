<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\FormServiceProvider;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new SessionServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new TwigServiceProvider());

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
}));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

$app['swiftmailer.options'] = array(
    'host' => 'WALTER-PC',
    'port' => '25',
    'username' => 'username',
    'password' => 'password',
    'encryption' => null,
    'auth_mode' => null
);

// Fix: https://stackoverflow.com/questions/9480604/silex-form-validation-without-translation
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));
// Doctrine DB
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'    => array(
        'driver'        => 'pdo_sqlite',
        'user'          => 'root',
        'password'      => '',
        'path'          => __DIR__.'/../empleos.db',
        'charset'       => 'utf8',
    ),

    /*
     *


    'db.options'    => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'nuevabase',
        'user'      => 'root',
        'password'  => '',
    ),
     *
    */
));

// YML to Entities
$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    "orm.em.options" => array(
        "mappings" => array(
            array(
                "type"      => "yml",
                "namespace" => "Entity",
                "path"      => realpath(__DIR__."/../config/doctrine"),
            ),
        ),
    ),
));

return $app;
