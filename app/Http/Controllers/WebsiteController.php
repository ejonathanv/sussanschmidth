<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        $archives = Archive::all();
        return view('website.index', compact('archives'));
    }
}
