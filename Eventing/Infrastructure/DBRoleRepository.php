<?php

namespace Eventing\Infrastructure;

use Eventing\Model\RoleRepository;
use Eventing\Model\User;
use Eventing\Model\UserRole;
use PDO;

class DBRoleRepository implements RoleRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getForUser(User $user)
    {
        if (!$user->getId()) {
            return;
        }

        $sql = "SELECT r.* FROM users_roles ur
          INNER JOIN roles r ON r.id = ur.role_id
          INNER JOIN users u ON u.id = ur.user_id AND u.id = :user_id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':user_id' => $user->getId(),
        ]);

        $roles = $statement->fetchAll(PDO::FETCH_ASSOC);

        $rolesCollection = new \ArrayObject();
        foreach ($roles as $roleArr) {
            $role = new UserRole();
            $role->setId($roleArr['id']);
            $role->setName($roleArr['name']);
            $role->setDisplayName($roleArr['display_name']);
            $role->setDescription($roleArr['description']);
            $rolesCollection->append($role);
        }

        return $rolesCollection;
    }
}