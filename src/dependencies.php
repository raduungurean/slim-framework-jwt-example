<?php
// DIC configuration

use Eventing\Application\JwtGenerator;
use Eventing\Application\UserApplicationService;
use Eventing\Infrastructure\DBRoleRepository;
use Eventing\Model\UserFactory;
use Eventing\Presentation\Http\Controllers\UserController;
use Eventing\Presentation\Http\Controllers\AssociationController;
use Eventing\Infrastructure\DBUserRepository;
use Slim\Container;

$container = $app->getContainer();

$container['secret-key'] = 'sa9328343nd774788dhdhd-884747jjj99387jjhd-09';

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['pdo'] = function (Container $c) {
    $db = $c['settings']['db'];
    $pdo = new PDO(
        "mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'],
        $db['pass']
    );
    return $pdo;
};

// factories
$container['UserFactory'] = function (Container $c) {
    return new UserFactory(
        $c->get('RoleRepository')
    );
};

// repositories
$container['UserRepository'] = function (Container $c) {
    return new DBUserRepository(
        $c->get('pdo'),
        $c->get("UserFactory")
    );
};

$container['RoleRepository'] = function (Container $c) {
    return new DBRoleRepository(
        $c->get('pdo')
    );
};

// services
$container['JwtGenerator'] = function (Container $c) {
    return new JwtGenerator();
};
$container['UserApplicationService'] = function (Container $c) {
    return new UserApplicationService(
        $c->get('UserRepository'),
        $c->get('JwtGenerator'),
        $c->get('secret-key')
    );
};

// controllers
$container['UserController'] = function (Container $c) {
    return new UserController(
        $c->get('UserApplicationService')
    );
};

$container['AssociationController'] = function (Container $c) {
    return new AssociationController(
        $c->get('pdo')
    );
};