<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'country_id',
        'user_id',
        'payment_method_global',
        'recipient_id',
        'reason_id',
        'service_id',
        'payment_method_id',
        'amount',
        'recipient_amount',
        'grand_total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
