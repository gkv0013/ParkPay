<?php
namespace App;

use App\Models\User;

class Auth
{
    public static function login($user)
    {
        session_regenerate_id(true);
        $_SESSION['mem_id']=$user->mem_id;  
    }
    public static function logout()
    {
        $_SESSION = [];

        // Delete the session cookie
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // Finally destroy the session
        session_destroy();
    }

    public static function isLoggedIn()
    {
        return isset($_SESSION['mem_id']);

    }

    public static function getUser()
    {
        if(isset($_SESSION['mem_id'])){
            return User::findByID($_SESSION['mem_id']);

        }
    }
}