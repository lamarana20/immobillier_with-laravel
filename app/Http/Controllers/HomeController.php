<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use Termwind\Components\Dd;

class HomeController extends Controller
{
    public function index()
    {   
        $properties = Property::available()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    


        return view('home', ['properties' => $properties]);
    }
}
