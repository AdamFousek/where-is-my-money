<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    /**
     * Dashboard after log in
     *
     * @return \Inertia\Response
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    /**
     * Public index page
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return Redirect::route('dashboard');
        }

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'appName' => env('APP_NAME', 'Where is my money?')
        ]);
    }
}
