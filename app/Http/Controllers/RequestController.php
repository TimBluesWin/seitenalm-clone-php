<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    // Show the form
    public function show(): View
    {
        // read the JSON file for the country list. The json file is stored in the storage (not in subfolder app) folder.
        $countriesPath = storage_path() . "/countries-de.json"; 
        $countries = File::json($countriesPath);
        // pass the list of countries into the view.
        return view('welcome', [
            'countries' => $countries
        ]);
    }
}
