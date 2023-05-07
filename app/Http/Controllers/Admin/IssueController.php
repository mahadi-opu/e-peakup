<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Issue;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::latest()->get();

        return view('admin/issue/index', compact('issues'));
    }
}
