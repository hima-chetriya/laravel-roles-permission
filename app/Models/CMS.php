<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    use HasFactory;
    // protected $tabel = 'cms_pages';
    public $table = "cms_pages";
     protected $fillable = ['id','title','description'];
}
