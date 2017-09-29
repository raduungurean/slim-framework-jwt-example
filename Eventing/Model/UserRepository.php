<?php

namespace Eventing\Model;

interface UserRepository
{
    public function checkByUsernameAndPassword(User $user);
}