<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Booking extends Authenticated{
    /**
     * Show the index page
     *
     * @return void
     */
    public function bookingAction()
    {
        View::renderTemplate('Booking/Booking.html');
    }
}
