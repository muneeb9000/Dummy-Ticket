<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
       
         if (session('is_mobile')) {
            return view('pages.mobile');
        } else {
            return view('pages.home');
        }
    }

    public function contactUs()
    {
        return view('pages.contact-us');
    }

    public function correctionPolicy()
    {
        return view('pages.correction-policy');
    }

    public function faqs()
    {
        return view('pages.faqs');
    }

    public function refundPolicy()
    {
        return view('pages.refund-policy');
    }

    public function reviews()
    {
        return view('pages.reviews');
    }

    public function termsConditions()
    {
        return view('pages.terms-conditions');
    }

    public function flightReservation()
    {
        return view('forms.flight-reservation');
    }
}
