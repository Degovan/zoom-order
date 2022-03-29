<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 'zoom_account_id', 'till_date', 'status'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
