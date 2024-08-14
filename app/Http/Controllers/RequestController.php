<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
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
        // Creating lists for the date, month, and year so that we can simply for-loop them.
        // Actually it is better to use input type="date", but we try to make it as close to the original form
        // as possible.
        $daysList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
        $monthsList = ['Jan.', 'Feb.', 'März', 'Apr.', 'Mai', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Okt.', 'Nov.', 'Dez.'];
        $yearsList = ['2024', '2023', '2022', '2021', '2020', '2019', '2018', '2017', '2016', '2015', 
        '2014', '2013', '2012', '2011', '2010', '2009', '2008', '2007', '2006'];
        // pass the list of countries into the view.
        return view('welcome', [
            'countries' => $countries,
            'daysList' => $daysList,
            'monthsList' => $monthsList,
            'yearsList' => $yearsList

        ]);
    }

    public function validate(RegistrationFormRequest $request)
    {
        // In Laravel, whenever a validation inside request fails, the framework automatically redirect us
        // to the previous page, along with errors.
        return Redirect::back()->with('success', 'success');
        // 
    }
}
