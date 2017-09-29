<?php

namespace Eventing\Model;

class UserFactory
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function create($userData)
    {
        $user = new User();

        $user->setId($userData['id']);
        $user->setUsername($userData['username']);
        $user->setFirstName($userData['first_name']);
        $user->setLastName($userData['last_name']);
        $user->setEmail($userData['email']);
        $user->setPasswordEncrypted($userData['password']);
        $user->setCreatedAt($userData['created_at']);
        $user->setUpdatedAt($userData['updated_at']);
        $roles = $this->roleRepository->getForUser($user);
        if ($roles) {
            $user->setRoles($roles);
        }

        return $user;
    }
}