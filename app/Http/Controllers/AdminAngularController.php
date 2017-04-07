<?php

namespace App\Http\Controllers;

class AdminAngularController extends Controller
{
    /**
     * Serve the angular application.
     *
     * @return JSON
     */
    public function serveApp()
    {
        return view('admin');
    }
}
