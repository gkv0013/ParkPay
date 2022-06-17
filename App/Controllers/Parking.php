<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Parking extends Authenticated
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function parkingAction()
    {
        View::renderTemplate('Parking/Parking.html');
    }
}
