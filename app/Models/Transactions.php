<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'transaction_id';

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $fillable = ['stock_id', 'transaction_type', 'quantity', 'price_per_share', 'transaction_date', 'username', 'account_number'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'transaction_type' => 'string',
        'quantity' => 'int',
        'price_per_share' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];
}
