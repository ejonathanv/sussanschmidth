<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index(){
        $archives = Archive::orderBy('year', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(15);
        
        return view('admin.archives.index', compact('archives'));
    }
}
