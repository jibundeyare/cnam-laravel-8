<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $name = 'Foo';

        return view('main.index', [
            'name' => $name,
        ]);
    }
}
