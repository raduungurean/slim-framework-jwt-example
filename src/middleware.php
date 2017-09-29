<?php

use Slim\Middleware\JwtAuthentication;

$app->add(new JwtAuthentication([
    "secret" => $container->get('secret-key'),
    "secure" => false,
    "path" => "/v1",
    "algorithm" => [ "HS256" ],
    "passthrough" => [ "/v1/test", "/v1/user/authenticate"],
    "attribute" => "jwt"
]));
