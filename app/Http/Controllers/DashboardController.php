<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Service;
use App\Models\HowItWork;
use App\Models\Plan;
use App\Models\ProgressStatistic;
use App\Models\Contact;
use App\Models\ContactSubmission;

class DashboardController extends Controller
{
    public function index()
    {
       
        return view('admin.dashboard.index');
    }
}
