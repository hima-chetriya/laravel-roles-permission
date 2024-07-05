<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
       "footer_title1_en",
       "footer_title1_fr",

       "footer_title2_en",
       "footer_title2_fr",

       "footer_address_en",
       "footer_address_fr",

       "footer_content_en",
       "footer_content_fr",

       "footer_number1",
       "footer_number2",

       "footer_link1",
       "footer_link2",

       "footer_logo",
    ] ;
}
