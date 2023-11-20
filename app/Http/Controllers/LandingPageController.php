<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class LandingPageController extends Controller
{
    public function home(): Response
    {
        return Inertia::render('HomePage', [
            'title' => 'Home Page'
        ]);
    }

    public function about(): Response
    {
        return Inertia::render('AboutPage', [
            'title' => 'About Page'
        ]);
    }

    public function contact(): Response
    {
        return Inertia::render('ContactPage', [
            'title' => 'Contact Page'
        ]);
    }


}
