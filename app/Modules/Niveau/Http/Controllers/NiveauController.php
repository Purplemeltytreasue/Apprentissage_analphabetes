<?php

namespace App\Modules\Niveau\Http\Controllers;

use Illuminate\Http\Request;

class NiveauController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Niveau::welcome");
    }
}
