<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'youtube_homepage',
        'youtube_about',
        'youtube_send_money',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube'
    ];
}
