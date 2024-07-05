<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Response;
class QRCodeController extends Controller
{
    
    public function generateQrCode(Request $request)
    {
        $imagePath = '\public\images\blank_image.png';
        $qrCodeWithImage = QrCode::size(400)
                                  ->format('png')
                                  ->merge($imagePath)
                                  ->generate('https://www.binaryboxtuts.com/');
                                  dd($qrCodeWithImage);
        return view('qr-codes', ['qrCodeWithImage' => $qrCodeWithImage]);
    }

    // public function generateQrCode(Request $request)
    // {
    //     $imagePath = '/public/blank_image.png';

      
    //     $qrCodeWithImage = QrCode::size(400)
    //                               ->format('png')
    //                               ->merge($imagePath)
    //                               ->generate('https://www.binaryboxtuts.com/');
    //     return view('qr-codes', ['qrCodeWithImage' => $qrCodeWithImage]);
    // }

}