<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function setLang(Request $request)
    {
        $locale = $request->input('lang');
        App::setLocale($locale);
        Session::put("locale", $locale);
        return redirect()->back();
    }
}
