<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'phones' => 'json',
        'emails' => 'json',
        'messendgers' => 'json',
        'social_links' => 'json',
    ];
}
