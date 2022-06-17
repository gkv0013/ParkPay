<?php

namespace App\Controllers;

use App\Auth;
use \Core\View;
use \App\Models\User;
/**
 * Home controller
 *
 * PHP version 7.0
 */
class Login extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function tryAction()
    {
        View::renderTemplate('Login/Login.html');
    }
    public function loginAction()
    {
        View::renderTemplate('Login/Login.html');
    }

    public function createAction()
    {
        $user=User::authenticate($_POST['email'],$_POST['password']);
       
        if($user)
        {
            Auth::login($user);
            
            $this->redirect('/Home/index');

        }
        else{
            View::renderTemplate('Login/Login.html',['email' => $_POST['email'],]);
            
        }
    }
    public function destroyAction()
    {
        Auth::logout();
        $this->redirect('/Home/index');
    }
    
}
