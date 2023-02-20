<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Show joblist
     */
    public function showJob()
    {
        return view('frontend.job.index');
    }

    /**
     * Detail joblist
     */
    public function detailJob()
    {
        return "Detail Job";
    }
}
