<?php

namespace Vis\Builder;

use Controller, View, Redirect, Config, Input, Cookie, Response, Session, Lang;
use Sentry;

class LoginController extends Controller
{

    public function showLogin()
    {

        if (Sentry::check()) {
            return Redirect::to(Config::get('builder::admin.uri'));
        }

        return View::make('admin::vis-login');
    } // end showLogin

    public function postLogin()
    {
        try {

            Sentry::authenticate(
                array(
                    'email'    => Input::get('email'),
                    'password' => Input::get('password')
                ),
                Input::has('rememberme')
            );

            $onLogin = Config::get('builder::login.on_login');


            if (Input::has('is_from_locked_screen')) {
                return Response::json(array(
                    'status' => true
                ));
            }
            return Redirect::intended(Config::get('builder::admin.uri'));

        } catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) {
            if (Input::has('is_from_locked_screen')) {
                return \Response::json(array(
                    'status' => false,
                    'error'  => Lang::get('builder::login.not_found')
                ));
            }

            Session::put('tb_login_not_found', Lang::get('builder::login.not_found'));
            return Redirect::to(Config::get('builder::admin.uri'));
        }
    } // end 

    public function doLogout()
    {
        Sentry::logout();

        return Redirect::route("login_show");

    } // end doLogout



}