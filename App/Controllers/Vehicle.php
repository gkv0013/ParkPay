<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Vehicle extends Authenticated
{

    /**
     * Show the index page
     *
     * @return void
     */
    
    public function vehicleAction()
    {
        View::renderTemplate('Vehicle/Vehicle.html');
    }
}
