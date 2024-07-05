<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function languageChange(Request $request)
    {
      
        $locale = $request->input('locale');

        if (!in_array($locale, ['fr', 'en'])) {
            abort(400);
        }
        App::setLocale($locale);
    
        session()->put('locale', $locale);
        return response()->json(['success' => true]);
    }

}
