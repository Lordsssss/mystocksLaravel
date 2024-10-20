<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model{
    use HasFactory;
        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'account_number';
    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
        /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $fillable = ['user_id','stock_id','stock_symbol','quantity','average_price','username','account_number'];

    
    
}