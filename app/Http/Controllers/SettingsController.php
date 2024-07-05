<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
   public function index()
   {
    $edit_setting = Settings::find(1);
        return view('admin.settings.edit',compact('edit_setting'));
   }

   public function update(Request $request){
    // dd($request);
    $update_setting = Settings::find(1);
    $update_setting->footer_title1_en = $request->footer_title1_en;
    $update_setting->footer_title1_fr = $request->footer_title1_fr;


    $update_setting->footer_title2_en = $request->footer_title2_en;
    $update_setting->footer_title2_fr = $request->footer_title2_fr;

    $update_setting->footer_address_en = $request->footer_address_en;
    $update_setting->footer_address_fr = $request->footer_address_fr;

    $update_setting->footer_content_en = $request->footer_content_en;
    $update_setting->footer_content_fr = $request->footer_content_fr;

    $update_setting->footer_number1 = $request->footer_number1;
    $update_setting->footer_number2 = $request->footer_number2;

    $update_setting->footer_link1 = $request->footer_link1;
    $update_setting->footer_link2 = $request->footer_link2;

    if ($request->hasFile('header_logo')) {
    
        $imageName = time() . '.' . $request->header_logo->getClientOriginalExtension();
        $request->header_logo->move(public_path('images'), $imageName);
        $update_setting->header_logo = $imageName; 
    }
    if ($request->hasFile('footer_logo')) {
    
        $imageName = time() . '.' . $request->footer_logo->getClientOriginalExtension();
        $request->footer_logo->move(public_path('images'), $imageName);
        $update_setting->footer_logo = $imageName; 
    }
 
    $update_setting->save();
    
    return back()->with('success', 'Setting updated successfully');
   }
}
