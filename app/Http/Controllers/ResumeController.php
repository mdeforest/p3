<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        return 'Show the form to enter Resume data';
    }

    public function createResume()
    {
        return 'Process form data for the resume';
    }

    public function displayResume()
    {
        return 'display the resume that has been created';
    }
}
