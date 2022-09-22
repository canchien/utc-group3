<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'logo',
        'meta_description',
        'meta_keyword',
        'hotline',
        'email',
        'address',
        'youtube',
        'facebook',
        'zalo'
    ];
}
