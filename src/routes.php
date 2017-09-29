<?php

$app->group(
    '/v1', function () {
        $this->get('/test', 'UserController:test');

        // authentication stuff here
        $this->post('/user/authenticate', 'UserController:authenticate');

        // associations stuff here https://docs.phalconphp.com/en/3.0.0/reference/tutorial-rest.html
        $this->get('/association', 'AssociationController:getUserAssociations');
        $this->get('/association/{id}', 'AssociationController:getAssociation');
        $this->put('/association/{id}', 'AssociationController:updateAssociation');
        $this->post('/association', 'AssociationController:addAssociation');
        $this->post('/association/search', 'AssociationController:searchAssociation');
        $this->delete('/association/{id}', 'AssociationController:deleteAssociation');
    }
);