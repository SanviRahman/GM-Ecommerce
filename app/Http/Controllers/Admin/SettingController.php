<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index',compact('settings'));
    }
    public function store(Request $request)
    {
        if ($request->has('footer_open_days') || $request->has('footer_open_hours')) {
            $request->validate([
                'footer_open_days' => 'nullable|string|max:100',
                'footer_open_hours' => 'nullable|string|max:100',
            ]);
        }
        if ($request->has('lk_topbar_enabled')) {
            $request->validate([
                'lk_topbar_enabled' => 'required|in:0,1',
                'lk_topbar_call_enabled' => 'required|in:0,1',
                'lk_topbar_text' => 'nullable|string|max:255',
            ]);
        }
        if ($request->has('lk_collection_enabled')) {
            $request->validate([
                'lk_collection_enabled' => 'required|in:0,1',
                'lk_collection_eyebrow' => 'nullable|string|max:100',
                'lk_collection_heading' => 'nullable|string|max:150',
                'lk_collection_subtitle' => 'nullable|string|max:500',
                'lk_collection_description_heading' => 'nullable|string|max:160',
                'lk_collection_description' => 'nullable|string|max:1500',
                'lk_collection_categories' => 'nullable|array|max:30',
                'lk_collection_categories.*' => 'integer|distinct|exists:categories,id',
            ]);
            Setting::set('lk_collection_category_ids', implode(',', $request->input('lk_collection_categories', [])));
        }
        if ($request->has('lk_whatsapp_button_enabled') || $request->has('lk_call_button_enabled')) {
            $request->validate([
                'lk_whatsapp_button_enabled' => 'nullable|in:0,1',
                'lk_call_button_enabled' => 'nullable|in:0,1',
            ]);
        }
        $keys = $request->except('_token', 'lk_collection_categories');


        if($request->imageID){
            Setting::set('site_logo', $request->imageID);
        }else{
            foreach ($keys as $key => $value){
                Setting::set($key, $value);
            }
        }

        return redirect('/admin/setting'.($request->query('tab') === 'collections' ? '?tab=collections' : ''));
    }
}
