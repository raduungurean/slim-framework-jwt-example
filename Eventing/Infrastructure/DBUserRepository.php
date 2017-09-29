<?php

namespace Eventing\Infrastructure;

use Eventing\Model\User;
use Eventing\Model\UserFactory;
use Eventing\Model\UserRepository;
use PDO;

class DBUserRepository implements UserRepository
{
    private $pdo;
    private $userFactory;

    public function __construct($pdo, UserFactory $userFactory)
    {
        $this->pdo = $pdo;
        $this->userFactory = $userFactory;
    }

    public function checkByUsernameAndPassword(User $user)
    {
        if (!$user->getPassword() || !$user->getUsername()) {
            return false;
        }

        $sql = "SELECT u.* FROM users u WHERE u.username = :username";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':username' => $user->getUsername(),
        ]);

        $userArr = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$userArr) {
            return false;
        }

        if (!password_verify($user->getPassword(), $userArr['password'])) {
            return false;
        }

        return $this->userFactory->create($userArr);
    }
}