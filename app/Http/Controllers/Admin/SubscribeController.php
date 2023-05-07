<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Subscribe;

class SubscribeController extends Controller
{
    public function index()
    {
        $subscribes = Subscribe::latest()->get();

        return view('admin/subscribe/index', compact('subscribes'));
    }
}
