<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use DB;
use Exception;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin/settings/index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'facebook'  => 'required|url',
            'instagram' => 'required|url',
            'youtube'   => 'required|url',
            'twitter'   => 'required|url',
            'linkedin'  => 'required|url',
            'youtube_homepage'  => 'required|url',
            'youtube_about'  => 'required|url',
            'youtube_send_money'  => 'required|url',
        ]);

        DB::beginTransaction();

        try {
            $data = $request->only('facebook', 'instagram', 'youtube', 'twitter', 'linkedin', 'youtube_homepage', 'youtube_about', 'youtube_send_money');

            $setting = Setting::first();
            $setting->update($data);

            DB::commit();
            return back()->with('success', 'Changes saved.');
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return back()->with('success', 'Failed to save.');
        }
    }
}
