<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{

    /**
     * The controller that handles displaying the SPA Vue application
     * Shouldn't be messed with under any circumstances.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('spa');
    }
}
