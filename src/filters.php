<?php


//++
Route::filter('check_permissions', function()
{
    if (Request::isMethod('get')) {
        Jarboe::checkNavigationPermissions();
    }
});

Route::filter('auth_admin', function()
{
    //secure of ip
    if (count(Config::get('builder::admin.limitation_of_ip'))) {
        $ipUser = Request::getClientIp(true);

        if (!in_array($ipUser, Config::get('builder::admin.limitation_of_ip'))) {
            return Response::make('Ограничение по ip. Ваш ip не входит в список разрешенных', 401);
        }
    }

    if (!Sentry::check()) {
        if (Request::ajax()) {
            $data = array(
                "status" => "error",
                "code" => "401",
                "message" => "Unauthorized"
            );
            return Response::json($data, "401");
        } else {
            return Redirect::guest('login');
        }
    } else {
        if (!Sentry::getUser()->isSuperUser()) {
            // FIXME:
            $admin = Sentry::findGroupByName('admin');
            if (!Sentry::getUser()->inGroup($admin)) {
                if (Request::ajax()) {
                    $data = array(
                        "status" => "error",
                        "code" => "401",
                        "message" => "Unauthorized"
                    );
                    return Response::json($data, "401");
                } else {
                    return Redirect::guest('/');
                }
            }
        }
    }
});


