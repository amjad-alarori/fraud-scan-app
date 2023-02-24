<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    use HasFactory;

    protected $fillable = ['scan_datetime'];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
}
