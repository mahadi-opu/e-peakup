<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;

class SettingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rate' => 'required|numeric',
        ]);

        $setting = Setting::first();
        $setting->update([
            'rate' => $request->rate
        ]);

        return back()->with('success', 'Rate updated!');
    }
}
