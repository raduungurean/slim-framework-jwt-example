<?php

namespace Eventing\Application;

use Eventing\Model\User;
use Eventing\Model\UserRepository;

class UserApplicationService
{
    private $userRepository;
    private $jwtGenerator;
    private $secretKey;

    public function __construct(UserRepository $userRepository, JwtGenerator $jwtGenerator, $secretKey)
    {
        $this->userRepository = $userRepository;
        $this->jwtGenerator = $jwtGenerator;
        $this->secretKey = $secretKey;
    }

    public function getByUsernameAndPassword($username, $password)
    {
        $user = new User();
        $user->setUsername($username);
        $user->setPassword($password);

        $user = $this->userRepository->checkByUsernameAndPassword($user);
        $jwt = null;

        if (!$user) {
            return false;
        } else {
            $jwtGenrator = $this->jwtGenerator;
            $jwt = $jwtGenrator($user, $this->secretKey);
        }

        $rolesForJson = [];
        $roles = $user->getRoles();
        foreach($roles as $role) {
            $rolesForJson[] = [
                'id' => $role->getId(),
                'name' => $role->getName(),
                'display_name' => $role->getDisplayName()
            ];
        }

        $forJson = [
            'user' => [
                'id' => $user->getId(),
                'username' =>$user->getUsername(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'created_at' => $user->getCreatedAt(),
                'updated_at' => $user->getUpdatedAt(),
                'roles' => $rolesForJson,
            ],
            'token' => $jwt,
        ];

        return $forJson;
    }
}