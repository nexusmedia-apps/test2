<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $table = 'orders';
    protected $primaryKey = 'id';
    protected $foreignKey = 'customer_id';

    /**
     *
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = ['customer_id', 'total_price', 'financial_status', 'fulfillment_status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
