<?php

namespace App\Controllers;
use \App\Auth;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Profile extends Authenticated
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function profileAction()
    {
        View::renderTemplate('Profile/Profile.html',['user'=>Auth::getUser()]);
        
    }
}
