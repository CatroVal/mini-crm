<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LocalizationController extends Controller
{
    public function index($locale) {
        //Setting the locale which will be passed throughout route using App facade
        App::setlocale($locale);

        //storing the locale in session to get it back in the middleware
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
