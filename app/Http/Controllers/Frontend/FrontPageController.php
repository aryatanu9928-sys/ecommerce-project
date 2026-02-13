<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class FrontPageController extends Controller
{
    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
