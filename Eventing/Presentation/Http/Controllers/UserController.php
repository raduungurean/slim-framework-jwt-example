<?php

namespace Eventing\Presentation\Http\Controllers;

use Eventing\Application\UserApplicationService;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
    private $userAppService;

    public function __construct(UserApplicationService $userAppService)
    {
        $this->userAppService = $userAppService;
    }

    public function authenticate(Request $request, Response $response, $args)
    {
        header('Content-Type: application/json');

        $post = $request->getParsedBody();

        $username = $post['username'];
        $password = $post['password'];


        $authenticated = $this->userAppService
            ->getByUsernameAndPassword($username, $password);

        if ($authenticated) {
            return $response->withJson($authenticated);
        } else {
            return $response->withJson([
                'error' => true,
                'message' => 'Invalid username or password'
            ]);
        }
    }

    /** testing purposes **/
    public function test(Request $request, Response $response, $args)
    {
        header('Content-Type: application/json');

        $json = $this->userAppService
            ->getByUsernameAndPassword('radu', 'sinel24');

        echo json_encode($json);
    }
}