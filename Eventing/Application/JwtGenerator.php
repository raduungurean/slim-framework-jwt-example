<?php

namespace Eventing\Application;

use Eventing\Model\User;
use Firebase\JWT\JWT;

class JwtGenerator
{
    public function __invoke(User $user, $secretKey)
    {
        $token = [
            "iss" => "http://pf.local",
            "iat" => time(),
            "nbf" => time(),
            'exp' => strtotime("+12 month"),
            "data" => [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'password' => $user->getPasswordEncrypted(),
                // 'roles' => $user->getRolesArray(),
            ],
        ];

        $jwt = JWT::encode($token, $secretKey);

        return $jwt;
    }
}