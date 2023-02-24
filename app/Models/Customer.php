<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'bsn',
        'first_name',
        'last_name',
        'date_of_birth',
        'phone_number',
        'email',
        'tag',
        'ip_address',
        'iban',
        'fraud',
    ];

    public function scan()
    {
        return $this->belongsTo(Scan::class);
    }
}
