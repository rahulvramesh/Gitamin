<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gitamin\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the groups routes class.
 */
class GroupsRoutes
{
    /**
     * Define the groups routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['web', 'app.hasSetting'],
            'setting' => 'app_name',
            'as' => 'groups.',
        ], function ($router) {
            $router->get('groups', [
                'as' => 'index',
                'uses' => 'GroupsController@indexAction',
            ]);
            $router->get('groups/new', [
                'as' => 'new',
                'uses' => 'GroupsController@newAction',
            ]);

            $router->post('groups/create', [
                'as' => 'create',
                'uses' => 'GroupsController@createAction',
            ]);

            $router->get('{owner_path}/edit', [
                'as' => 'group_edit',
                'uses' => 'GroupsController@editAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+');
            $router->post('{owner_path}', [
                'as' => 'group_update',
                'uses' => 'GroupsController@updateAction',
            ])->where('owner_path', '[a-zA-z.0-9_\-]+');
        });
    }
}
