<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('landing.home');
    }

    public function about()
    {
        return view('landing.section-about.section-about');
    }

    public function service()
    {
        return view('landing.section-services.section-services');
    }

    public function token()
    {
        return view('landing.section-token.section-token');
    }

    public function faq()
    {
        return view('landing.section-faq.section-faq');
    }

    public function price()
    {
        return view('landing.section-price.section-price');
    }

    public function news()
    {
        return view('landing.section-news.section-news');
    }

    public function preguntasFrecuentes()
    {
        return view('preguntas-frecuentes');
    }
}
