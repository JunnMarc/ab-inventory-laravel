<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'employee_id',
        'supplier_id',
        'date',
        'balance_forwarded',
        'pull_out',
        'new_balance',
        'new_luto',
        'total_inventory',
    ];
}
