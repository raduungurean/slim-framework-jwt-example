<?php

namespace Eventing\Model;

interface RoleRepository
{
    public function getForUser(User $user);
}