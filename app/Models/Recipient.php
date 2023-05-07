<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country_id',
        'name',
        'number',
        'service_id',
        'payment_method_id',
        'account_type',
        'address',
        'city',
        'email',
        'reason_id',
    ];

    public function recipient_account_type()
    {
        return $this->belongsTo(Type::class, 'account_type');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
