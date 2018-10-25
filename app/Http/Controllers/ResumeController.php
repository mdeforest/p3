<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        return view('resume.index');
    }

    public function createResume()
    {
        return 'Process form data for the resume';
    }

    public function displayResume()
    {
        return view('resume.display');
    }
}
