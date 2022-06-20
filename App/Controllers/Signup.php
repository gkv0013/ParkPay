<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Signup extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function signupAction()
    {
        View::renderTemplate('Signup/Signup.html');
    }


    public function createAction()
    {
        //var_dump($_POST);

        $user = new User($_POST);
        
        if ($user->save()) {
            $this->redirect('/Signup/success');

            //View::renderTemplate('Signup/Success.html');
        } else {

            //View::renderTemplate('Signup/Signup.html');
           // View::renderTemplate('Signup/Signup.html'   );
            View::renderTemplate('Signup/Signup.html', [
                'user' => $user
            ]);
            //var_dump($user->errors);
        }
    }


    public function successAction()
    {
        View::renderTemplate('Signup/Success.html');

    }
}
