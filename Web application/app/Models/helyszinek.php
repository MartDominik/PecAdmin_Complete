<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class helyszinek extends Model
{
    use HasFactory;

    protected $fillable =[

        'nev',
        'befogadohelyek',
        'helyszin'
    ];

}
